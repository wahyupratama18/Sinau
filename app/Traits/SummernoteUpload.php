<?php
namespace App\Traits;

use DOMDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Create User
 */
trait SummernoteUpload
{

    /**
     * Upload Summernote Images 
     * @param mixed $text
     * @param string|null $sub
     * @param string $folder
     * @param string $storage
     * @return string|false
    */
    public function upload($text, string $sub = null, string $folder = 'public', string $storage = 'storage')
    {
        $dom = new DOMDocument();
        $dom->loadHTML($text, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Change Image base64 to store
        foreach($dom->getElementsByTagName('img') as $img){
  
            $data = $img->getAttribute('src'); 
            list($type, $data) = explode(';', $data);
            list($type, $data) = explode(',', $data);
  
            $data = base64_decode($data);
  
            $uri = ($sub ? $sub.'/' : '').Str::random(16).'-'.$img->getAttribute('data-filename');
            $path = "$folder/$uri";
  
            Storage::put($path, $data);
  
            $img->removeAttribute('src');
            $img->setAttribute('src', asset($storage.'/'.$uri));
  
        }

        return $dom->saveHTML();
    }

}
