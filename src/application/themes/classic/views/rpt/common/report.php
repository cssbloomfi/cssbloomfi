

<?php
if(isset($this->tableFormatInfo['css'])) echo $this->tableFormatInfo['css'];
if(isset($this->tableFormatInfo['js'])) echo $this->tableFormatInfo['js'];
?>
<h2><?php echo $this->heading; ?></h2>
<?php
require_once(ROOT_DIR.'/application/modules/rpt/views/scripts/helpers/reporthelper.js');

$this->showXlsDownloadSection($this->xlsResults);
if($this->form){
?>

<div class="entry-section">
	<fieldset>
		<legend class="icon-div">
			<img src="<?= $this->images['search']; ?>" class="icons" >
			Search
		</legend>
		<div class="search-section">
			<?= $this->form; ?>
		</div>
	</fieldset>
</div>

<?php } ?>

<fieldset>

<?php if($this->paginator['data']){ ?>
	<fieldset class="export_section">
	<legend>Export </legend>
		<?=  $this->xlsExportForm; ?>
	</fieldset>
<?php
}
if($this->srch){
$searchResultString=$this->searchString( $this->sparams, $this->slabels); ?>
<div class="search-result-string"><img src="<?= $this->images['searchResult']; ?> class="search-result-icons"  > <?= $searchResultString; ?></div>
<?php
}
$params=$this->pagiParams['pagination_params'];
if($this->paginator['data']){
?>
	<div class="pagination"><?php echo $this->paginationControl($this->paginator['paginator'],
										'Sliding',
										'/partials/my_pagination_control.phtml', $params ); ?></div>
<?php }

 $table=new BinaryBl_GenerateReportTable;
 $tableData=$table->generateDataTable($this->tableFormatInfo,$this->paginator['data'],$this->windowData,'zebra');
 if(isset($tableData['script'])) echo $tableData['script'];
if(isset($tableData['divs'])) echo $tableData['divs'];
 echo $tableData['table'];


if($this->paginator['data']){ ?>
	<div class="pagination"><?php echo $this->paginationControl($this->paginator['paginator'],
										'Sliding',
										'/partials/my_pagination_control.phtml', $params ); ?></div>
<?php } ?>
</fieldset>