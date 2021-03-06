<?php

/** Use filter in tables list
* @link http://www.adminer.org/plugins/#use
* @author Jakub Vrana, http://www.vrana.cz/
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerTablesFilter {
	function tablesPrint($tables) {
?>

<p class="jsonly"><input id="searchFilter" onkeyup="tableFilterKeyEvent(this.value);">

<script type="text/javascript">

	var $searchFilter = document.querySelector('#searchFilter');
	$searchFilter.addEventListener('keydown', function(e) {
		if (e.key == 'Escape') {
			$searchFilter.select();
		}
	});

	var timeoutId = 0;
	function tableFilterKeyEvent(value){
		clearTimeout(timeoutId);
		timeoutId = setTimeout(function(){
			tablesFilter(value);
		}, 200);
	}
	// function tablesFilter(value) {
	// 	document.cookie = 'searchFilterValue=' + value;
	// 	var tables = document.getElementById('tables');
	// 	var menu = document.getElementById('menu');
	// 	tables.setAttribute('style', 'display:hidden;');
	// 	var table_spans = tables.getElementsByTagName('span');
	// 	var result = [];
	// 	var newMenu = document.createElement('div');
	// 	for (var i = table_spans.length; i--; ) {
	// 		var a = table_spans[i].children[1];
	// 		var text = a.innerText || a.textContent;
	// 		// table_spans[i].className = (text.indexOf(value) == -1 ? 'hidden' : '');
// // 			table_spans[i].className = (text.match(new RegExp(value, 'i')) ? '' : 'hidden');
// // 			a.innerHTML = text.replace(value, '<b>' + value + '</b>');

	// 		if(text.match(new RegExp(value, 'i'))){
	// 			var span = document.createElement('span');

	// 			span.appendChild(table_spans[i]);
	// 			result.push(span);
	// 		}
	// 	}
	// 	newMenu.innerHTML = result.join('');
	// 	menu.appendChild(newMenu);
	// }
	function tablesFilter(value) {
		document.cookie = 'searchFilterValue=' + value;
		var tables = document.getElementById('tables').getElementsByTagName('span');
		for (var i = tables.length; i--; ) {
			var a = tables[i].children[1];
			var text = a.innerText || a.textContent;
			// tables[i].className = (text.indexOf(value) == -1 ? 'hidden' : '');
			tables[i].className = (text.match(new RegExp(value, 'i')) ? '' : 'hidden');
			a.innerHTML = text.replace(value, '<b>' + value + '</b>');
		}
	}
</script>

<?php
		echo "<p id='tables' onmouseover='menuOver(this, event);' onmouseout='menuOut(this);'>\n";
		$lang = lang('select');
		foreach ($tables as $table => $type) {
			echo '<span>';
			echo '<a href="' . h(ME) . 'select=' . urlencode($table) . '"' . bold($_GET["select"] == $table) . ">" . $lang . "</a> ";
			echo '<a href="' . h(ME) . 'table=' . urlencode($table) . '"' . bold($_GET["table"] == $table) . ">" . h($table) . "</a>";
			echo '<br>';
			echo '</span>';
		}
		return true;
	}
}
?>

<script>
	window.onload = function(){
		var searchFilter = document.getElementById('searchFilter');

		if(searchFilter){
			var searchFilterValue = document.cookie.replace(/(?:(?:^|.*;\s*)searchFilterValue\s*\=\s*([^;]*).*$)|^.*$/, "$1");
			searchFilter.value = searchFilterValue;
			tablesFilter(searchFilterValue);
		}
	}
</script>

