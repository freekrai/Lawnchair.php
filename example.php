<?php
include("Lawnchair.php");

/*	you can choose to use sql or file as a datastore:	*/
/*	SQL:	*/
//	$ppl = new Lawnchair( array("name"=>"people","store"=>"sql") );
/*	S3:	*/
//	$ppl = new Lawnchair( array("name"=>"people","store"=>"s3",'awsaccesskey'=>'Your AWS Access Key','awssecretkey'=>'Your AWS Secret Key','bucketname'=>'Your Bucket Name') );
/*	File:	*/
$ppl = new Lawnchair( array("name"=>"people","store"=>"file") );

if( $ppl->count() < 1 ){
	for($i = 0; $i <= 15000;$i++){
		$ppl->save( array("value"=>array("name"=>$i,"age"=>($i+2),"address"=>"random street") ) );
	}
}
echo "<h1>List all Keys</h1>";
if( $ppl->count() < 10 ){
	echo "<pre>".print_r($ppl->keys(),true)."</pre>";
}else{
	echo "<p>Too many keys to list at once.. {$ppl->count()} keys found..</p>";
}

echo "<h1>Find all people with '2' in the name </h1>";
$list = $ppl->find(array("field"=>"name","q"=>"2","a"=>"eq"));
echo "<pre>".print_r($list,true)."</pre>";

echo "<h1>List All People</h1>";
echo "<pre>".print_r($ppl->all(),true)."</pre>";

echo "Last Record is: ".print_r($ppl->max(),true)."<br />";
echo "Last Key is: ".$ppl->lastid();

echo "<h1>Max with callback</h1>";
echo "----> ".$ppl->max( function($member) { return "My name is: ".$member['name']; } )."<br />";

#$ppl->nuke();
