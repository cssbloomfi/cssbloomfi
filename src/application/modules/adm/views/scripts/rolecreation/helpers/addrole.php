
<?php
$script='<script type="text/javascript">
$(function(){
	$(".cancel").click(function(){
	 self.location="'.$this->url.'";
	});
});
</script>'; 

echo $script;
?>


