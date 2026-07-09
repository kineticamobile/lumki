<?php

namespace Kineticamobile\Lumki;

use Illuminate\Support\Str;

class Lumki
{

    public static function insertLineAfter($path, $needle, $replace)
    {
        return self::insertLine($path, $needle, $replace,true);
    }

    public static function insertLineBefore($path, $needle, $replace)
    {
        return self::insertLine($path, $needle, $replace,false);
    }

    public static function insertLine($path, $needle, $insert, $after = true)
    {
        if( ! file_exists($path) ){
            return "The file doesn't exists!";
        }

        $content = file_get_contents($path);
        $eol = Str::contains($content, "\r\n") ? "\r\n" : "\n";
        $normalizedContent = str_replace("\r\n", "\n", $content);

        if(Str::contains($normalizedContent, $insert)){
            return "The line already exists";
        }

        $contentToReplaceNormalized = collect(explode("\n",$normalizedContent))->map(
            function ($line) use($needle, $insert, $after){
                if(Str::contains($line, $needle)){
                    return $after ? "$line\n$insert":"$insert\n$line";
                }
                return $line;
            }
        )->join("\n");

        if($contentToReplaceNormalized != $normalizedContent){
            $contentToWrite = $eol === "\r\n"
                ? str_replace("\n", "\r\n", $contentToReplaceNormalized)
                : $contentToReplaceNormalized;

            file_put_contents($path, $contentToWrite);
            return "Line Added '$insert'";
        }else{
            return "Unmodified Content. '$insert' line not added";
        }


    }
}
