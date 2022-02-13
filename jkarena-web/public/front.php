<body id="body" class="pageFront">

<div id="container">
	<div class="box" id="pageHeader">
		<span id="title">Jedi Knight Arena</span>
		<span id="subtitle">A level-modification for Jedi Knight</span>
	</div>
	<div class="box" id="contentContainer">
		<?include('menu.php');?>
		
		
		<div id="content">
		<h1>Jedi Knight Arena</h1>
			<p>Is a level-modification for Jedi Knight. This means that specific levels, designed for
			JKArena, will play entirely different from the normal Jedi Knight playing style.
			Jedi Knight Arena is a fast paced 1 on 1 fighting scenario based on the Quake 3 mod,
			Rocket Arena.</p>
			
			<p>Jedi Knight Arena:</p>
			<ul>
			  <li>Pits players in 1 on 1 death match, regulated by cogs</li>
			  <li>Is an entirely new mode of gameplay, like CTF</li>
			  <li>Allows the host to select which weapons will be used in the matches</li>
			  <li>Carries this selection over levels placed in a JK &quot;level pack&quot;</li>
			  <li>Features a queue system to decide who plays who, when</li>
			  <li>Allows players to leave the queue at their desire</li>
			  <li>Carries this setting over levels placed in a JK &quot;level pack&quot;</li>
			</ul>
			
			<p>The initial developer kit will be released first, followed by a competition among JK
			level authors for the creation of a JKArena level pack, which will be officially sponsored
			by The Massassi Temple. Levels will be judged by the JKArena authors, and the pack will be
			released, hopefully, about one or two weeks after the developer kit.</p>
			
			<h2>How it works</h2>
			
			<p>Players join, and spawn in the spectator section. They are automatically added to the queue.
			Players are able to remove and enter themselves into the end of the queue by pressing the queue
			toggle buttons. When there are at least two players in the queue, the JKArena creates a match.
			The two players are transported to ghost positions in the arena, given selected weapons and ammo by the cog,
			and fight to the death. The
			winner stays in the arena and then the cogs create a new match when another player is in the queue.
			In a two player game, the two players will just be in new matches when the dead player respawns.</p>
			<p>JKArena changes the scoring system a bit. A suicide in a match will result in a positive point
			going to the opposite player, and no points for the suicidal player. When the score limit is reached,
			the game displays a message about who is the winner and cycles to the next level in the pack.</p>
			<p>The weapons room is an interesting part of JKArena. Only the host may enter it. From here he can
			pick and choose what weapons the arena combatants may use. When he leaves the room, these settings are
			applied.</p>
			<p>When the game cycles to a new level, players will not lose either their queue settings or the weapons
			settings made by the host. This is a very cool feature in JKArena, and was a pain to cog.</p>
			
			<p>For more information, use the side menu.</p>
		</div>
		
		
	</div>
</div>