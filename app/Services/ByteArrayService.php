<?php

namespace App\Services;

class ByteArrayService
{
    private $data;
    private $position;

    public function __construct($buffer)
    {
        $this->data     = $buffer;
        $this->position = 0;
    }

    public function readByte()
    {
        if ($this->validate(1)) {
            return $this->data[$this->position++];
        }
        return null;
    }

    public function readBytes($length)
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $this->readByte();
        }
        return $result;
    }

    public function readUnsignedByte()
    {
        if ($this->validate(1)) {
            return ord($this->data[$this->position++]);
        }
        return null;
    }

    public function readUnsignedShort()
    {
        $byte1 = $this->readUnsignedByte();
        $byte2 = $this->readUnsignedByte();
        return $byte2 << 8 | $byte1;
    }

    public function readUTF()
    {
        $length = $this->readUnsignedShort();
        return $this->readBytes($length);
    }

    private function validate($bytes)
    {
        return $this->position + $bytes <= strlen($this->data);
    }
}

