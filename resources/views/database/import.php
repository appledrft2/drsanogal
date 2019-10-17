<form method="POST" action="#">
  
  <input type="file" name="file" placeholder="file">
  <input type="submit" name="btnImport" value="Import">
</form>
<?php

if(isset($_POST['btnImport'])){
  $connection = mysqli_connect('localhost','root','','test');
  $filename = $_POST['file'];
  $handle = fopen($filename,"r+");
  $contents = fread($handle,filesize($filename));
  $sql = explode(';',$contents);
  foreach($sql as $query){
    $result = mysqli_query($connection,$query);
    if($result){
        echo '<tr><td><br></td></tr>';
        echo '<tr><td>'.$query.' <b>SUCCESS</b></td></tr>';
        echo '<tr><td><br></td></tr>';
    }
  }
  fclose($handle);
  echo 'Successfully imported';
}
?>