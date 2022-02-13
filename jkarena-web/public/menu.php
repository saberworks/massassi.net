		<div class="box" id="menu">
			<dl id="menuLinks">
				<dt id="menuLabel">Menu</dt>
				<dt><a href="index.php" id="linkFront">&middot; Overview</a></dt>
				<dt><a href="index.php?x=news" id="linkNews">&middot; News</a></dt>
				<dt><a href="index.php?x=levelpack" id="linkPack">&middot; Level Pack</a></dt>
				<dt><a href="index.php?x=download" id="linkDownload">&middot; Download</a></dt>
				<dt><a href="index.php?x=competition" id="linkCompetition">&middot; Competition</a></dt>
				<dt><a href="index.php?x=forauthors" id="linkForAuthors">&middot; For Authors</a></dt>
			</dl>
			<div id="styleSelect">Themes:
				<a href="#" onclick="setActiveStyleSheet('JK Arena Green');">1</a>
				<a href="#" onclick="setActiveStyleSheet('JK Arena Blue');">2</a>
				<a href="#" onclick="setActiveStyleSheet('JK Arena Dark');">3</a>
				<?if($extra){?><a href="#" onclick="setActiveStyleSheet('JK Arena Green Fixed Menu');">4</a><?}?>
			</div>
		</div>
