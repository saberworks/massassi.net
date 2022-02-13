<body id="body" class="pageForAuthors">

<div id="container">
	<div class="box" id="pageHeader">
		<span id="title">Jedi Knight Arena</span>
		<span id="subtitle">A level-modification for Jedi Knight</span>
	</div>
	<div class="box" id="contentContainer">
		<?include('menu.php');?>
		
		
		<div id="content">
		<h1>The Devkit Readme</h1>
<h3>Contents</h3>

<dl>
<dt><a href="#1.0">1.0 Contents of the ZIP</a>
<dd><a href="#1.1">1.1 MATS</a>
<dd><a href="#1.2">1.2 COGS</a>
<dd><a href="#1.3">1.3 WAVS</a>
<dd><a href="#1.4">1.4 Other</a>

<dt><a href="#2.0">2.0 Implementation</a>
<dd><a href="#2.1">2.1 MATS</a>
<dd><a href="#2.2">2.2 COGS</a>
<dd class="x"><a href="#2.2.1">2.2.1 queue_indicator.cog</a>
<dd class="x"><a href="#2.2.2">2.2.2 weapons_toggle.cog</a>
<dd class="x"><a href="#2.2.3">2.2.3 arena_main.cog</a>
<dd class="x"><a href="#2.2.4">2.2.4 arena_client.cog</a>
<dd><a href="#2.3">2.3 WAVS</a>
<dd><a href="#2.4">2.4 MASTER.TPL</a>
<dd><a href="#2.5">2.5 Basic Level Design Issues</a>

<dt><a href="#3.0">3.0 Credits</a>
</dl>

<div class="hr"></div>

<h3><a name="1.0"></a>1.0 Contents of the ZIP</h3>

<p>The Arena Dev Zip contains all of the files necessary to create new Jedi Knight Arena levels.
 This includes the JKA gameplay cogs, and the wave files and  textures commonly used in JKA
 levels.</p>

  <h4><a name="1.1"></a>1.1 MATS</h4>

   <p>The following material files should be found in the zip:

   <ul>
   <li>exit2.mat  
   <li>queue_toggle2.mat - Label for Observer's Queue buttons.
   <li>set_weaps2.mat
   </ul>

  <h4><a name="1.2"></a>1.2 COGS</h4>

   <p>The following cog files should be found in the zip:

   <ul>
   <li>queue_indicator.cog - Additional feature for Observer's Queue buttons.
   <li>weapons_toggle.cog - Controls which weapons are available to players
   <li>arena_main.cog - JKA Gameplay core cog
   <li>arena_client.cog - JKA Gameplay core cog
   </ul>

  <h4><a name="1.3"></a>1.3 WAVS</h4>

   <p>The following sound files should be found in the zip:
<ul>
   <li>one.wav - "One"
   <li>two.wav - "Two"
   <li>three.wav - "Three"
   <li>fight.wav - "Fight!"
   <li>welcome.wav - "Welcome to Jedi Knight Arena."</ul>

  <h4><a name="1.4"></a>1.4 Other</h4>

   <p>These files should also be found in the zip:

   <ul>
   <li>readme.txt - This help file.
   <li>weapons_room.jed - This is a template for a weapons room. While you may use it in
                      your level, an industrious author will create his own to fit the
                      level.
   <li>master.tpl - This is a template file for JED. JKArena requires a change in the "walkplayer"
                template in order to function. WITHOUT THIS FILE IN YOUR JED DIRECTORY JKARENA
                WILL NOT WORK.
   <li>jka_demo.jed - An excessively  basic, 5 minute demo level of how JKA is supposed to
                  function. Do not use this as a gameplay model; the level breaks alot of our
                  recommendations: its pretty big, is totally symmetrical, and is essentially
                  a box. If this level were submitted, it would be rejected.
   <li>jka_demo.gob - The gob compilation of the above level.
   </ul>

<div class="hr"></div>

<h3><a name="2.0"></a>2.0 Implementation</h3>

 <p>Implementation of these resources can be difficult and confusing. The following section 
 will assist you with installing each cog, texture, and sound into your level. As well, the
 last part of this section has some level design tips from the JKA devs themselves.</p>

  <h4><a name="2.1"></a>2.1 MATS</h4>
   
   <p>The mats should be placed in your project directory (or project directory/mat)
   They can then be select in JED and placed near the appropriate buttons. Be sure to label
   at the very least the queue toggle.</p>

  <h4><a name="2.0"></a>2.2 COGS</h4>
  
  <div class="indent">

   <h4><a name="2.2.1"></a>2.2.1 queue_indicator.cog</h4>

    <p>Queue_indicator.cog is used to make your Observer Queue buttons show as
    activated (when a player is in the queue) or deactivated (when a player is not
    in the queue). It talks to the arena_main.cog at the beginning of the level 
    and sets the button's state locally.</p>

    <p>To implement this cog, add it to your placed cogs (F7). You will then need to
    select all of the surfaces you are using as queue toggles and put them into the
    q_anim# boxes. The q_anim_cel# should be set to 0 if the surface's "activated" cel
    is the second one, or 1 if it is the first cel. The sounds should be fairly self
    explanatory.</p>

    <p>In order for this cog to work, your Observer Queue buttons must be multi-cel
    mats. That means they must have an 'on' and 'off' texture combined in the one
    mat. Good mats to use for your queue buttons can be found in Jedi Knight's default
    texture set under the names 00t_#.mat, where # is a number between 2 and 8.</p>

    <p>This cog is optional, but highly recommended (it is difficult to tell your current 
    queue status without it.)</p>

   <h4><a name="2.2.2"></a>2.2.2 weapons_toggle.cog</h4>

    <p>Weapons_toggle.cog is used to control which weapons are available to players
    in the arena. It is also the most difficult cog to implement. You will need to
    create a 'weapons room.' This is a room that only the host can enter, and is where
    the host can fiddle with the weapons settings. Your weapons room must have three
    switches. One is used to exit the weapons room, one is used to scroll through the
    weapons, and the last one is used to either enable or disable the currently selected
    weapon. You will also need to have a ghost thing to display the currently selected 
    weapon. The ghost thing should not be physically obtainable by the player, or the
    host could, in theory, grab it and fire it in the observer area.</p>

    <p>To implement this cog, add it to your placed cogs (F7). A bunch of things to fill
    in will be shown, but don't worry, you won't need to add them all:</p>
<ul>
     <li>switch_weapons OR tswitch_weapons - A surface or thing that the host activates to
                                         scroll through the weapons in the weapons room.</li>
    
     <li>toggle_weapon - A surface that activates or deactivates the currently selected weapon.</li>

     <li>exit_weapons_room OR texit_weapons_room - A surface or thing that the host activates
                                               to leave the weapons room and return to the
                                               Observer area.</li>

     <li>display_weapon - A ghost thing that should be located where the currently selected 
                      weapon will be shown.</li>

     <li>weapons_room OR tweapons_room - The surface or thing that the host activates to 
                                     get into the weapons room. This surface or thing should
                                     be located in the Observer area, not the arena itself.</li>

     <li>weapons_room_jump - A ghost thing that should be placed where the host will appear in
                         the weapons room when he/she teleports in. Make sure this thing is
                         at least .2 units above the ground, or the host could get stuck in
                         the floor or crash.</li>

     <li>deactsnd - A sound that plays when a weapon is removed from the arsenal (toggle_weapon)</li>
  
     <li>actsnd - A sound that is played when a weapon is added to the arsenal (toggle_weapon)</li>

     <li>togglesnd - A sound that is played when the switch_weapons object is activated.</li>
</ul>
    <p>Once those are all implemented, you should be able to test it yourself by starting a new
    game and hitting the weapons_room surface  or tweapons_room thing. You should teleport
    into the weapons room at the weapons_room_jump object. Pressing the switch_weapons
    surface or tswitch_weapons thing should display a weapon where you placed your
    display_weapon ghost. Make sure that your toggle_weapon surface has at least two cels
    (preferable 'on' and 'off' cels), or else you will not be able to tell if a weapon is
    activated or deactivated. Pressing your exit_weapons_room surface or texit_weapons_room
    thing should return you to your arena's Observer area where you left it. For homogeny,
    we recommend that the switch_weap button be on the left, and the on/off toggle on the
    right.</p>
    
    <p>This cog must be included in your placed cogs, though you do not need to create a
    weapons room or fill in any of it's values if you wish your level to be restricted to
    all weapons all the time.</p>

   <h4><a name="2.2.3"></a>2.2.3 arena_main.cog</h4>

    <p>This cog controls pretty much all of the Arena functions. It must be placed in your
    project directory (or project directory/cog) and added to your placed cogs (F7). The top
    two things should be assigned to ghost objects where you want your two duelers to spawn
    INSIDE your arena. The other four surfaces should be assigned to queue toggle buttons.
    See Queue_toggle.cog for more information on queue toggle buttons.</p>

   <h4><a name="2.2.4"></a>2.2.4 arena_client.cog</h4>

    <p>This cog should be placed in your project directory (or project directory/cog/), but
    should _NOT_ be added to your placed cogs. If it is, your arena will not function
    correctly.</p>
</div>

  <h4><a name="2.3"></a>2.3 WAVS</h4>

   <p>The wav files should be placed in your project directory (or project 
   directory/sound). There is no other implementation required for the
   sound files. They will be gobbed with your level and called by the
   arena_*.cog files when appropriate.</p>
   
  <h4><a name="2.4"></a>2.4 MASTER.TPL</h4>

    <p>All you need to do to implement this is to place the file in your root level directory.
    JED should take care of the rest, but you may need to find "Reload Templates" in the
    JED menu for the change to take effect.</p>

    <p>It is REQUIRED for JKArena to function at all. There are some very important changes to
    the walkplayer template.</p>
    
    <p>If you have already changed your master.tpl, you can fix it by overwriting the WALKPLAYER
    template. It can be found right near the top; it is the second one down. Replace it with this
    template:</p>
    
    <code class="box">    # DESC: Player<br />
    # BBOX: -.037301 -.013874 -.118461 .038114 .03984 .064544<br />
    walkplayer        _actor             type=player thingflags=0x20000401 light=0.200000 model3d=ky.3do size=0.065000 movesize=0.065000 puppet=ky.pup soundclass=ky.snd cog=arena_client.cog surfdrag=3.000000 airdrag=0.500000 staticdrag=0.300000 health=100.00 maxhealth=100.00 maxthrust=2.00 typeflags=0x1 error=0.50 fov=0.71 chance=1.00</code>
    
    <p>The only real change is that now cog=arena_client.cog.</p>

  <h4><a name="2.5"></a>2.5 Basic Level Design Issues</h4>

<ul>
   <li>You should have a queue toggle button within 4 seconds of a walkplayer in the level.
     This is so, in a two player match, the host could possibly have time to remove
     him/herself from the queue and get to the weapons room in order to change weapons.</li>

   <li>You should be able to see MOST of the arena from any other point inside the arena. 
     Large, sprawling arenas may be fun for hide and seek, but they do not make for good, 
     fast-paced action.</li>

   <li>All walkplayers should be placed in the observer area. There should be no way to get
     from the observer area to the arena itself. The observer area should have a good view
     of the arena, but should not be overboard or distracting from the arena itself. You
     should not be able to get from the arena to the observer area during gameplay, but
     shooting into it is fine, since observers are invulnerable.</li>

   <li>Arenas, for the most part, should not be completely symmetrical. There are some 
     exceptions to this rule, but for the most part it makes for slightly more confusing
     gameplay.</li>
     
   <li>Do not put weapons in the arenas.</li>
</ul>

<div class="hr"></div>

<h3><a name="3.0"></a>3.0 Credits</h3>
<dl>
 <dt>Cog Work:
  <dd>Brian, Brad, Riskha

 <dt>Level Design:
  <dd>Brian, Brad, Juz, [More]

 <dt>Developer Documentation:
  <dd>Juz, Brad
  
 <dt>Weapons room template:
  <dd>Juz, Brad
  
 <dt>Sounds:
  <dd>Dethlord

 <dt>Web Site:
  <dd>Brad
  
 <dt>
</dl>
		</div>
		
		
	</div>
</div>