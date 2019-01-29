<?php
/**
 * Created by PhpStorm.
 * User: wap58
 * Date: 21/12/18
 * Time: 11:52
 */

/**
 * décrypté le code
 * cd lettre CD
 *
 */

function RD($message,$decrypt=false,$first='8',$second='B'){$sText='';$letters=str_split($message,($decrypt?7:1));foreach($letters as $letter){if($decrypt){$currentLetter=function() use ($letter,$first,$second){$val=0;$binaire=str_split($letter,1);foreach($binaire as $key => $bin){if($bin==$first){$val += [64,32,16,8,4,2,1][$key];}}return chr($val); };}else{$currentLetter=function() use ($letter,$first,$second){ $val = ord($letter); $fakeBin ='';foreach([64,32,16,8,4,2,1] as $bin){if($val >= $bin){$fakeBin .= $first;$val -= $bin;}else $fakeBin.= $second;}return $fakeBin;};} $sText.= $currentLetter();}return $sText;}


class ReaderFactory {

    public static function reader(ISupport $type) {
        if($type instanceof BR) return new ReaderBR($type);
        if($type instanceof DVD) return new ReaderDVD($type);
        if($type instanceof CD) return new ReaderCD($type);
    }
}
interface ISupport {
    public function getData();
}
class DVD implements ISupport {
    public function getData() {
        return 'DVVDVDVDDVVDVDVDVVVVVDDDVVDDDDDVDVDDDVDVVDDDDVVDDVDVVVVVDDDVDVDDDVDDDVVDVVVVVDVVVDVVDVDVDDVDVVVDVV';
    }
}
class CD implements ISupport {
    public function getData() {
        return 'CDDCDCDCCDDCDCDCDDDDDCCCDDCCCCCDCDCCCDCDDCCCCDDCCDCDDDDDCCCDCDCCCDCCCDDCDDDDDCDDDDCCCDDDCDD';
    }
}
class BR implements ISupport {
    public function getData() {
        return 'BRRBRBRBBRRBRBRBRRRRRBBBRRBBBBBRBRBBBRBRRBBBBRRBBRBRRRRRBBBRBRBBBRBBBRRBRRRRRBRRRRBRBBRBBRRBBBRBRBBBRRBRBRBRBBRBBRBRRBRBBRRRRBBBBBRRB';
    }
}
interface IReader {
    public function __construct(ISupport $support);
    public function readData();
}
class ReaderCD implements IReader {
    private $support;

    public function __construct(ISupport $support) {
        $this->support = $support;
    }

    public function readData() {
        echo RD($this->support->getData(),true,'C','D');
    }
}
class ReaderDVD implements IReader {
    private $support;

    public function __construct(ISupport $support) {
        $this->support = $support;
    }

    public function readData() {
        echo RD($this->support->getData(),true,'D','V');
    }
}
class ReaderBR implements IReader {
    private $support;

    public function __construct(ISupport $support) {
        $this->support = $support;
    }

    public function readData() {
        echo RD($this->support->getData(),true,'B','R');
    }
}


$support = new DVD();
ReaderFactory::reader($support)->readData();
