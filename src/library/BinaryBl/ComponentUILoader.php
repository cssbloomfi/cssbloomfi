<?php
class BinaryBl_ComponentUILoader extends ZendExtend_Url
{
	protected $_components=null;

	function __construct($compList=null,$UIType='LIST',$type=null,$params=null,$ul=true,$movable=true)
	{
		$components=$htmlScript=$class=$className=$parameters=$id=$height=$width=$jsScript=$cid=
		$compClassStart=$compClassEnd=null;

		//print_r($compList);

		if($compList && is_array($compList))
		{
		if(isset($params['class'])){
			$class=$params['class'];
			$className="class='".$class."'";
		}else{
			$class='component';
			$className="class='".$class."'";
		}
		if($UIType=='LIST' || $UIType==null)
		{
				$screenId=$compList['screenId'];
				$cssScript=<<<CSS
CSS;
				if($movable==true){
					$jsScript=<<<JS
						<script type="text/javascript">
							$(function() {
								$(".$class").sortable({
									revert: true
								});
								$("ul, li").disableSelection();
							});
						</script>
JS;
					$cid="id='sortable_$screenId'";
				}else{
					$compClassStart='<div style="border:1px solid #A6A6A6;margin:10px 10px 20px 10px;">';
					$compClassEnd='</div>';
				}
				if($ul==true)$htmlScript="<ul $className $cid>";
				$i=0;
				foreach($compList as $list){
						$id=$width=$height=$divIdPrefix=null;

						if(isset($list['params']) && $list['params']!=null ){
							if(isset($list['params']['id']))$id=$list['params']['id'];
							if(isset($list['params']['width']))$width=$list['params']['width'];
							if(isset($list['params']['height']))$height=$list['params']['height'];
						}
						if($params){
							if(isset($params['divIdPrefix']))$divIdPrefix=$params['divIdPrefix'];
						}
						if($list['type']=='CHART' && ($type==null || $type=='CHART'))
						{
							$modelName=new $list['model'];
							$method=$list['method'];
							$comHeader='<div class="component-header-chart">'.$list['name'].'</div>';
							if(!isset($list['params']))
								$component=$modelName->$method();
							else{
								$component=$modelName->$method($id,$width,$height);
							}
							if($ul==true)$htmlScript.='<li>'.$compClassStart.$comHeader.$component['component'].
							$compClassEnd.'</li>';
							else $htmlScript.=$component['component'];
							unset($modelName);
						}
						else if($list['type']=='AJAX' && ($type==null || $type=='AJAX'))
						{
							$path=$this->getBaseURL().'/'.$list['path'];
						//	die;
							$time=microtime();
							$timeIds=explode(' ',$time);
							$id='comp'.$timeIds[0].$timeIds[1];
							$comp='<div id="'.$id.'"></div>';
							$comp.='<script type="text/javascript">'."
							callajaxloading2(null,'".$id."','".$path."');".'</script>';
							$comp.=<<<CSS
										
CSS;

							$compClassStart1='<div style="border:1px solid #A6A6A6;margin:10px 10px 20px 10px;">';
							$compClassEnd1='</div>';
							if($ul==true) $htmlScript.='<li>'.$compClassStart1.$comp.$compClassEnd1.'</li>';
							else $htmlScript.=$comp;
						}
						$i++;
				}
				if($ul==true)
				$htmlScript.="</ul>";
			}else
			if($type=='accordian')
			{
				$cssScript=<<<CSS
CSS;
				$jsScript=<<<JS
					<script type="text/javascript">
						$(function() {
							$("#accordion$screenId").accordion({
								active: false,
								alwaysOpen: false,
								collapsible: true,
							});
						});
					</script>
JS;
				if($ul==true)
				$htmlScript="<ul $className id='sortable_$screenId'>";
				$i=0;
				foreach($compList as $list){
						if($list['type']=='CHART' && ($type==null || $type=='CHART'))
						{
							$modelName=new $list['model'];
							$method=$list['method'];
							if($params==true)
								$component=$modelName->$method();
							else{
								$component=$modelName->$method();
							}
							if($ul==true)$htmlScript.='<li>'.$component['component'].'</li>';
							else $htmlScript.=$component;

							unset($modelName);
						}
						else if($list['type']=='AJAX' && ($type==null || $type=='AJAX'))
						{
							$path=$this->getBaseURL().'/'.$list['path'];
							$time=microtime();
							$timeIds=explode(' ',$time);
							$id='comp'.$timeIds[0].$timeIds[1];
							$comp='<div id="'.$id.'"></div>';
							$comp.='<script type="text/javascript">'."
							callajaxloading2(null,'".$id."','".$path."');".'</script>';
							$comp.=<<<CSS
								<br>
								<style type="text/css">
									#$id { width:100%; }
								</style>
CSS;
							if($ul==true) $htmlScript.='<li>'.$comp.'</li>';
							else $htmlScript.=$comp;
						}
						$i++;
				}
				if($ul==true)
				$htmlScript.="</ul>";
			}
		$this->_components= $cssScript.$jsScript.$htmlScript;
		}else
			echo '<div style="border:1px solid #A6A6A6;margin:10px;padding:10px;background:#F5F5F5;"><h1 style="color:#FF0000;">No component data found.</h1></div>';

	}

	function getComponentUI()
	{
		return $this->_components;
	}
}
?>