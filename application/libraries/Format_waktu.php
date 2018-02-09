<?php
class Format_waktu {
  // libary jam waktu indonesi timur
  public function jam(){
    $waktu = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
    return $waktu->format('H:i:s');
  }
}

?>
