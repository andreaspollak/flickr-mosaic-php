<?php

require dirname(__FILE__) . '/api_key.php';

$response = flickr_api::download_all_photos_by_username('meetrajesh');
print_r($response);

class flickr_api {

    public static function download_all_photos_by_username($username) {

        $params['user_id'] = self::get_user_id_from_username($username);
        $params['per_page'] = '10';
        $params['page'] = 0;
        $num_photos = 0;

        $output_dir = __DIR__ . '/output';
        if (!is_dir($output_dir)) {
            mkdir($output_dir, 0755);
        }

        while (++$params['page'] == 1 || ($params['page'] < $result['pages'] && $num_photos < $result['total'])) {

            $result = self::call('flickr.people.getPublicPhotos', $params);

            foreach ($result['photo'] as $photo) {
                $num_photos++;
                $photo_url = 'http://farm{farm-id}.staticflickr.com/{server-id}/{id}_{secret}_s.jpg';

                $photo_url = preg_replace_callback('/{(.+)}/U', function($field) use ($photo) {
                        $field = preg_replace('/-id$/', '', $field[1]);
                        return $photo[$field];
                    }, $photo_url);

                $output_file = spf('%s/output/%s', __DIR__, basename($photo_url)); 

                if (!file_exists($output_file)) {
                    echo "Downloading $photo_url\n";
                    exec(spf('wget --quiet -O %s %s', $output_file, $photo_url));
                }
            }

            break;

        }
        
    }

    public static function get_user_id_from_username($username) {

        $params['username'] = $username;
        $result = self::call('flickr.people.findByUsername', $params);

        return $result['id'];
    }

    public static function call($method, $params) {

        $endpoint = 'https://secure.flickr.com/services/rest/';

        $params['method'] = $method;
        $params['api_key'] = FLICKR_API_KEY;
        $params['format'] = 'json';

        $response = file_get_contents($endpoint . '?' . http_build_query($params));
        $response = preg_replace(array('/^jsonFlickrApi\(/', '/\)$/'), '', $response);
        $response = json_decode($response, true);

        //var_dump($response);exit;

        unset($response['stat']);
        return array_shift($response);

    }

}

function v($a) {
    var_dump($a);
}

// shorthand for sprintf/vsprintf
function spf($format, $args=array()) {
    $args = func_get_args();
    $format = array_shift($args);
    if (isset($args[0]) && is_array($args[0])) {
        $args = $args[0];
    }
    return vsprintf($format, $args);
}