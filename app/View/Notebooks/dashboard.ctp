<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
//$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())

$description = 'notebooks: a collection of notes'

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>

		<link href="/todo/img/icon.ico" type="image/x-icon" rel="icon">

		<?php
			echo $this->Html->css('cake.generic');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');

		?>



	<script type="text/javascript" src="/todo/js/jquery-2.1.3.min.js"></script>

	<script type="text/javascript" src="/todo/js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">

		// tinymce initiation


		tinymce.init({
		    selector: "textarea",
				convert_urls : false,
				plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor colorpicker textpattern"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",

		});

		// group, notebook, and note delete confirmations

		function doOnClick(tourl){
			if (window.confirm('Are you sure?')){
				window.location = tourl;
			};
		}

		</script>

</head>
<body>
	<div id="container">
		<div id="header" class='header'>
			<h1><?php echo $description; ?></h1>
		</div>
		<div id="content">






<?

function getGroupFromId($groupid, $_groups){
	$groupTitle = '';

	foreach ($_groups as $_group) {
		if ( $groupid == $_group['groups']['id'] ) {
			$groupTitle = $_group['groups']['title'];
		}
	}
	return $groupTitle;
}

$aGroup=$this->Session->read('Active.GroupId');
$aNotebook=$this->Session->read('Active.NotebookId');


?>

<div class="notebooks container">

	<div class="notebooks left">
		<table cellpadding='0' cellspacing='0' class='leftNav'>
			<tr><th colspan='3' class='title'><b>Groups<? //echo "|".$aGroup."|".$aNotebook; ?><b></th></tr>
			<?
			foreach ($_groups as $_group) {
				// output group
				echo "<tr><td colspan='2'>".$_group['groups']['title']."</td><td class='icons'>";
				echo "<a href='/todo/groups/edit/".$_group['groups']['id']."'><img src='/todo/img/gear.png'/></a>";
				echo "<a href=\"javascript:doOnClick('/todo/groups/delete/".$_group['groups']['id']."');\"><img src='/todo/img/trash.png'/></a>";

				echo "</td></tr>";
				foreach ($_notebooks as $_notebook) {
					// output notebook
					if ( $_notebook['notebooks']['group_id'] == $_group['groups']['id'] ) {
						echo "<tr><td style='width:10px;'></td><td>";
						echo "<a href='/todo/dashboard/both/".$_group['groups']['id']."/".$_notebook['notebooks']['id']."'>".$_notebook['notebooks']['title']."</a>";
						echo "</td><td class='icons'>";
						echo "<a href='/todo/notebooks/edit/".$_notebook['notebooks']['id']."'><img src='/todo/img/gear.png'/></a>";
						echo "<a href=\"javascript:doOnClick('/todo/notebooks/delete/".$_notebook['notebooks']['id']."');\"><img src='/todo/img/trash.png'/></a>";
						echo "</td></tr>";
					}
				}
			}
			echo "<tr><td colspan='3'>";
			echo "<a class='action' href='/todo/dashboard/newgroup/'>+ New Group</a>";
			echo "<a class='action' href='/todo/dashboard/newnotebook/'>+ New Notebook</a>";
			echo "</td></tr>";
			?>
		</table>
	</div>

	<div class="notebooks middle">
		<table cellpadding='0' cellspacing='0' class='middleNav'>
			<tr>
				<?
				if ( $this->Session->read('Active.GroupId') != '' ) {
					// display selected groups name
					$groupTitle = getGroupFromId($this->Session->read('Active.GroupId'), $_groups);
					echo "<th class='SelectedGroup'>".$groupTitle."</th>";

					// display selected notebook tab
					foreach($_notebooks as $_notebook) {
						if ( $_notebook['notebooks']['id'] == $this->Session->read('Active.NotebookId') ) {
							echo "<td class='SelectedNotebookTab'>".$_notebook['notebooks']['title']."</td>";
						}
					}

					// display N other notebook tabs
					$count = 0;
					foreach($_notebooks as $_notebook) {
						if ( $count < 4 && $_notebook['notebooks']['group_id'] == $this->Session->read('Active.GroupId')) {
							if ( $_notebook['notebooks']['id'] != $this->Session->read('Active.NotebookId') ) {
								// other notebooks
								echo "<td class='NotebookTab'>";
								echo "<a href='/todo/dashboard/notebook/".$_notebook['notebooks']['id']."'>";
								echo $_notebook['notebooks']['title'];
								echo "</a></td>";
								$count++;
							}
						}
					}
				} else {
					// no group selected
					echo "<td class='greyed title'>No notebooks selected</td>";
				}
				?>
				<th class="spacer"></th>
				<tr><td colspan='100'>
					<?

					if ( $this->Session->read('Active.noteFlag') == 'add' ) {

						//echo 'Add Note:'.$this->Session->read('Active.noteFlag').$this->Session->read('Active.NotebookId');
						echo $this->Form->create('Note', array('controller'=>'notes', 'action'=>'add', 'novalidate'=>'true'));
						//echo "<fieldset>";
						echo "<table cellpadding='0' cellspacing='0' class='form'><tr><td>";
						echo $this->Form->input('title', array('class'=>'dashboard'));
						echo "</td></tr><tr><td>";
						echo $this->Form->input('body', array('class'=>'dashboard', 'rows'=>'10'));
						echo "</td></tr><tr><td>";
						echo $this->Form->input('notebook_id', array('selected'=>$this->Session->read('Active.NotebookId'), 'class'=>'dashboard'));
						//echo "</fieldset>";
						echo "</td></tr><tr><td>";
						echo $this->Form->end(__('Submit', array('class'=>'dashboard'
							, 'before'=>"tinyMCE.triggerSave();")));
						echo "</td></tr></table>";

					}

					if ( $this->Session->read('Active.noteFlag') == 'edit' ) {

						//echo 'Edit Note:'.$this->Session->read('Active.noteFlag').$this->Session->read('Active.NotebookId');
						echo $this->Form->create('Note', array('controller'=>'notes', 'action'=>'edit', 'novalidate'=>'true'));
						//echo "<fieldset>";
						echo "<table cellpadding='0' cellspacing='0' class='form'><tr><td>";
						echo $this->Form->input('id');
						echo $this->Form->input('title', array('class'=>'dashboard'));
						echo "</td></tr><tr><td>";
						echo $this->Form->input('body', array('class'=>'dashboard', 'rows'=>'10'));
						echo "</td></tr><tr><td>";
						echo $this->Form->input('notebook_id', array('selected'=>$this->Session->read('Active.NotebookId'), 'class'=>'dashboard'));
						//echo "</fieldset>";
						echo "</td></tr><tr><td>";
						echo $this->Form->end(__('Submit', array('class'=>'dashboard'
							, 'before'=>"tinyMCE.triggerSave(); tinyMCE.execCommand('mceRemoveControl', true, 'ModelField');")));
						echo "</td></tr></table>";

					}

					?>
				</td></tr>
			</tr>
			<tr><td colspan='100'><? echo $this->Session->flash(); ?></td></tr>
		</table>
	</div>

	<div class="notebooks right">
		<table cellpadding='0' cellspacing='0' class='rightNav'>
			<tr><th class='title' colspan='2'>Notes</th></tr>
			<?
			if ( $this->Session->read('Active.NotebookId') != '' ) {
				if ( count($_notes) < 1 ) {
					echo "<tr><td class='greyed'><a class='action' colspan='2' href='/todo/dashboard/newnote/".$this->Session->read('Active.NotebookId')."'>+ New Note</a></td><td></td></tr>";
				} else {
					foreach( $_notes as $_note ) {
						if ( $_note['notes']['notebook_id'] == $this->Session->read('Active.NotebookId') ) {
							echo "<tr><td class='note'><a href='/todo/dashboard/editnote/".$_note['notes']['id']."'>".$_note['notes']['title']."</a></td><td class='icons'>";
							echo '<form action="/todo/notes/delete/'.$_note['notes']['id'].'" name="post_'.$_note['notes']['id'].'" id="post_'.$_note['notes']['id'].'" style="display:none;" method="post"><input name="_method" value="POST" type="hidden"></form>';
							echo '<a href="#" onclick="if (confirm(&quot;Are you sure you want to delete #'.$_note['notes']['id'].'?&quot;)) { document.post_'.$_note['notes']['id'].'.submit(); } event.returnValue = false; return false;"><img src="/todo/img/trash.png"></a>';
							//echo $this->Form->postLink(__('<img src="/todo/img/trash.png">'), array('action' => 'delete', $this->Session->read('Active.NotebookId')), array(), __('Are you sure you want to delete # %s?', $this->Session->read('Active.NotebookId')));
							echo "</td></tr>";
						}
					}
					echo "<tr><td class='greyed' colspan='2'><a class='action' href='/todo/dashboard/newnote/".$this->Session->read('Active.NotebookId')."'>+ New Note</a></td><td></td></tr>";
				}
			} else {
				echo "<tr><td class='greyed' colspan='2'><a class='action' href='/todo/dashboard/newnote/0'>+ New Note</a></td></tr>";
			}
			?>
		</table>
	</div>

</div>



</div>
<div id="footer">
	<p>
	</p>
</div>
</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
