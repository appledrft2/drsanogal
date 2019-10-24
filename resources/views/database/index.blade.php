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
					<form method="POST" action="#" enctype="multipart/form-data">
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

				 echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> Database Successfully Restored</div>';

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
			  

				$name       = $_FILES['file']['name'];  
			    $temp_name  = $_FILES['file']['tmp_name'];
			    $location = '/';
			    $path = $location.'import-'.$name;   

			    if(isset($name)){
			        if(!empty($name)){      
			               
			            if(move_uploaded_file($temp_name, $path)){
			                echo 'File uploaded successfully';
			            }
			        }       
			    }  else {
			        echo 'You should select a file to upload !!';
			    }

			  $handle = fopen($path,"r+");
			  $contents = fread($handle,filesize($path));
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

			 
			}
			?>


			<?php 

			if(isset($_POST['btnExport'])){

				if (env('APP_ENV') === 'production') {
			   $connection = mysqli_connect('us-cdbr-iron-east-02.cleardb.net','b9ca3abbc228b4','526b1e7e','heroku_ee6cfbce9e8c843');
			   $con2 = new mysqli('us-cdbr-iron-east-02.cleardb.net','b9ca3abbc228b4','526b1e7e','heroku_ee6cfbce9e8c843');
			}else{
				$connection = mysqli_connect('localhost','root','','drsanogal');
				$con2 = new mysqli('localhost','root','','drsanogal');
			}
				$tables = array();
				$result = mysqli_query($connection,"SHOW TABLES");
				while($row = mysqli_fetch_row($result)){
				  $tables[] = $row[0];
				}
				$return = '';
				echo '<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> Database Successfully Backed up</div>';
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
				$backname = "backup-".rand(1000,9999)."-".date('Y-m-d').".sql";
				$handle = fopen($backname,"w+");
				fwrite($handle,$return);
				fclose($handle);
				
				$sql2 = "INSERT INTO backuplists (name,created_at) VALUES(?,CURRENT_TIMESTAMP)";
				$query2 = $con2->prepare($sql2);
				$query2->bind_param("s",$backname);
				$query2->execute();

				
				

				echo '<div class="card"><div class="card-body"><a href="/'.$backname.'" class="btn btn-link btn-lg">Download Latest Backup File</a></div></div>';
				
			}

			 ?>
	<div class="card">
		<h4 class="card-header">Backup List</h4>
		<div class="card-body">
			<div id="mytable">
				<table id="table3" class="table table-bordered table-hover" id="table2">
				<thead>
					<tr>
						<th>Name</th>
						<th>Date</th>
						<th width="20%">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($backuplist as $list)
						<tr>
							<td>{{$list->name}}</td>
							<td>{{$list->created_at->isoFormat('MMM D YYYY, h:mm:ss a')}}</td>
					
							<td>
							<!-- 	<button class="btn btn-default btn-sm"><i class="fa fa-sync" title="Restore"></i> Restore</button> -->
								<a href="/{{$list->name}}" class="btn btn-primary btn-sm"><i class="fa fa-download" title="Download"></i> Download</a>

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
	</div>
	

@endsection



@section('script')
<script type="text/javascript">
		loadtb();
	   	function loadtb(){
	   		$( "#mytable" ).load( "/dashboard/database #mytable", function(){
			   $("#table3").DataTable({
	            dom: 'Bfrtipl'
	          });
			});
		   	}
</script>
@endsection
