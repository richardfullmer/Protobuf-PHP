<?php

// Remove the Spec stream wrapper prefix from __DIR__
$DIR = substr(__DIR__, strlen('spec://'));

require_once $DIR . '/../library/DrSlump/Protobuf.php';

use \DrSlump\Protobuf;

Protobuf::autoload();

include_once $DIR . '/protos/simple.php';

describe "JSON Codec"

    describe "serialize"

        it "should serialize a simple message"
            $simple = new Tests\Simple();
            $simple->foo = 'FOO';
            $simple->bar = 'BAR';
            $json = Protobuf\Codec\Json::encode($simple);
            $json. should. eq. '{"foo":"FOO","bar":"BAR"}';
        end.

    end;

    describe "unserialize"

        it "should unserialize a simple message"
            $json = '{"foo":"FOO","bar":"BAR"}';
            $simple = Protobuf\Codec\Json::decode('Tests\Simple', $json);
            $simple should be instanceof 'Tests\Simple';
            $simple->foo should equal 'FOO';
            $simple->bar should equal 'BAR';
        end.

    end;
end;