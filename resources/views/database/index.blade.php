@extends('layouts.app')
@section('title',$title)
@section('content')
	
	<div class="card ">
    
		<div class="card-body">
     		
			
			<div class="row">
				

				<div class="col-md-6">
					<h2>Database Backup</h2>
					<form method="POST" action="#">
						<div class="form-group">
						<input type="submit" name="btnExport" class="btn btn-info btn-md" value="Backup Database">
						</div>
					</form>
				</div>

				<div class="col-md-6">
					<h2>Database Restore</h2>
					<form method="POST" action="#">
						<div class="form-group">
							<small>Upload SQL file</small>
							<input type="file" name="file" class="form-control-file" placeholder="file" accept=".sql">
						</div>
						<input type="submit" name="btnImport" class="btn btn-info btn-md" value="Restore Database">
					</form>
				</div>

			</div>
		</div>
	</div>


	
			<?php

			

			if(isset($_POST['btnImport'])){
				echo '
				<div class="card collapsed-card">
					<div class="card-header">
					  <h4>Import log</h4>
					  <div class="card-tools " >
					      <button type="button" class="btn btn-tool" data-widget="collapse">
					        <i class="fas fa-plus"></i>
					      </button>
					   </div>
					</div>
					<div class="card-body">
				';

			if (env('APP_ENV') === 'production') {
			   $connection = mysqli_connect('us-cdbr-iron-east-02.cleardb.net','b9ca3abbc228b4','526b1e7e','heroku_ee6cfbce9e8c843');
			}else{
				$connection = mysqli_connect('localhost','root','','drsanogal');
			}
			  
			  $filename = $_POST['file'];
			  $handle = fopen($filename,"r+");
			  $contents = fread($handle,filesize($filename));
			  $sql = explode(';',$contents);
			  foreach($sql as $query){
			    $result = mysqli_query($connection,$query);
			    if($result){
			    	echo '<table style="overflow:scroll;" class="table table-bordered">';
			        echo '<tr><td><br></td></tr>';
			        echo '<tr><td>'.$query.' <b>SUCCESS</b></td></tr>';
			        echo '<tr><td><br></td></tr>';
			        echo '</table>';
			    }
			  }
			  fclose($handle);
			  
			  echo '
			  		</div>
			  	</div>
			  ';

			  echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> Database Successfully Imported</div>';

			}
			?>


			<?php 

			if(isset($_POST['btnExport'])){

				if (env('APP_ENV') === 'production') {
			   $connection = mysqli_connect('us-cdbr-iron-east-02.cleardb.net','b9ca3abbc228b4','526b1e7e','heroku_ee6cfbce9e8c843');
			}else{
				$connection = mysqli_connect('localhost','root','','drsanogal');
			}
				$tables = array();
				$result = mysqli_query($connection,"SHOW TABLES");
				while($row = mysqli_fetch_row($result)){
				  $tables[] = $row[0];
				}
				$return = '';
				foreach($tables as $table){
				  $result = mysqli_query($connection,"SELECT * FROM ".$table);
				  $num_fields = mysqli_num_fields($result);
				  
				  $return .= 'DROP TABLE '.$table.';';
				  $row2 = mysqli_fetch_row(mysqli_query($connection,"SHOW CREATE TABLE ".$table));
				  $return .= "\n\n".$row2[1].";\n\n";
				  
				  for($i=0;$i<$num_fields;$i++){
				    while($row = mysqli_fetch_row($result)){
				      $return .= "INSERT INTO ".$table." VALUES(";
				      for($j=0;$j<$num_fields;$j++){
				        $row[$j] = addslashes($row[$j]);
				        if(isset($row[$j])){ $return .= '"'.$row[$j].'"';}
				        else{ $return .= '""';}
				        if($j<$num_fields-1){ $return .= ',';}
				      }
				      $return .= ");\n";
				    }
				  }
				  $return .= "\n\n\n";
				}
				//save file
				$backname = "backup".date('Y-m-d').".sql";
				$handle = fopen($backname,"w+");
				fwrite($handle,$return);
				fclose($handle);

				
				echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> Database Successfully Backed up</div>';

				echo '<div class="card"><div class="card-body"><a href="/'.$backname.'" class="btn btn-link btn-lg">Download Backup File</a></div></div>';
				
			}

			 ?>
	
	

@endsection






