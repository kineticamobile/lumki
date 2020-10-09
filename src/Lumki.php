<?php

namespace Kineticamobile\Lumki;

use Illuminate\Support\Str;

class Lumki
{
    public static function insertLine($path, $needle, $insert, $after = true)
    {
        if( ! file_exists($path) ){
            return "The file doesn't exists!";
        }

        $content = file_get_contents($path);
        if(Str::contains($content, $insert)){
            return "The line already exists";
        }

        $contentToReplace = collect(explode("\n",$content))->map(
            function ($line) use($needle, $insert, $after){
                if(Str::contains($line, $needle)){
                    return $after ? "$line\n$insert":"$insert\n$line";
                }
                return $line;
            }
        )->join("\n");

        if($contentToReplace != $content){
            file_put_contents($path, $contentToReplace);
            return "Line Added '$insert'";
        }else{
            return "Unmodified Content. '$insert' line not added";
        }


    }
}
