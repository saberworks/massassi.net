---
title: COG programming - Output Functions
author: MastaJedi
email: hill@golden.net
description: >
    Learn to format text output generated by cog outputs
date: 1998-06-05
original: cogoutput.htm
category: jk
---

#### Tutorial Information:
|                        |                                          |
| ---------------------- | ---------------------------------------- |
| Tutorial Type:         | COG programming - Output Functions       |
| Target Audience:       | Newbies, special interest in text output |
| Degree of Explanation: | detailed                                 |
| Author:                | MastaJedi                                |
| Dated:                 | June 5, 1998                             |

###1. What the heck am I reading?

This is a tutorial on formatting text output generated by code
in cogs.  When I refer to output, I am specifically referring to the
yellow text lines which occur at the top of the player screen during
gameplay.  The COG reference section in JKSpecs version 0.3 refers very
briefly to the commands associated with output, but there isn't much
explanation as to their function or use.  Through testing and debugging,
I've got them all (well, all but two REALLY...but they aren't important
:-) figured out, so trust that everything I write here has already been
put to practical and successful use.  
   
###2. The forked path: the high and low road of putting out

There's two ways to go about sending text or data to the player
during run time: the Print() series of commands and the jkString()
series of commands.  
   
The Print() commands, though simple, are also very inflexible in
the way they are formatted.  The jkString() commands provide that
flexibility by allowing you to build a **string** from a bunch of
sources, mixing text and numeric variables all into one and spitting it
out on the same line.

A "string" is just a fancy way of saying "text" and includes
most if not all ascii symbols, but it's important to know that a string
is only a "string" of "words" and can't be used to do anything but make
some kind of statement.  A string is only used to pass on information to
the person sitting in front of the computer screen, and doesn't store
any information useful to the game itself.  For example, numbers in a
string can't be used in calculations - the string "4" has the same
meaning to us people as the string  "four", but is not the same as the
integer 4.  
   
Strings are always surrounded by quotation marks, so it's easy
to distinguish between them.

An example of jkString formatting might be:

"**PLAYER\_NAME** has **SCORE** kills and is **WINNING\_OR\_LOSING**"

where PLAYER\_NAME is an ascii variable depending on what that player's
name is for that game, SCORE is an integer representing that player's
score, and WINNING\_OR\_LOSING is either the word "winning" or "losing",
depending on how good that player's score is compared to everyone
else's.  All the other text is pre-formatted and unchangeable, inserted
to give sense to the 3 variables in the line.  We've also seen this type
of formatting when the familiar text goes "PLAYER\_NAME has become more
powerful than he can possibly imagine."  :-)

**Where to stick it...**

Both methods of formatting output place one line of ascii
centered near the top of the screen in yellow text.  Exactly where the
text is placed is related to whether there's anything displayed there
already.  JK and MotS can only display 5 lines of text at a time, and
each line is displayed for 5 seconds each*.*  So if there's already 2
lines of text at the top of the screen when either a print() or
jkStringOutput() is executed, this latest line of ascii will be printed
under the 2 existing lines of text until their time runs up.  
   
###3. Quick and Dirty, Harry

Print() commands are quick and dirty, and are the simplest to
use.  Each Print() command in this group is executed on a separate line,
and are formatted "as is", centered on that line.  So for example, if
the symbol SOME\_NUMBER is equal to 5, PrintInt(SOME\_NUMBER), when
executed, will print a lonely number 5, centered on it's own line at the
top of the player screen.  In this family of commands are:  
 

####Simple Output Formatting Functions
|   |   |
| - | - |
| Print("string") | This simply prints whatever is between the quotations. |
| PrintInt(**int**) | This prints a single integer number.  **Int** is any integer number, or an integer defined symbol. |
| PrintFlex(**flex**) | This prints a single decimal number.  **Flex** is any decimal number or flex defined symbol. |
| PrintVector(**vector**) | The output of this command prints a set of 3 decimal numbers separated by a space in the order x, y, z.  **Vector** is a set of three decimal numbers associated with defining movement, or some point in space, usually referred to as x, y and z in that order. |
| jkPrintUNIString(**Int1**, **Int2**) | This prints a string stored in a UNI file.<br/><br/>**Int1** is an integer representing the player that the message will be sent to.  This is often set with a comand like GetLocalPlayerThing() or GetSourceRef().  This can also be a negative number representing certain groups of players:<br/><br/>(-3) here sends the message to the server AND all clients<br/>(-2) sends only to the clients<br/>(-1) sends only to the server.<br/><br/>I'm positive about the (-3) meaning, but (-2) and (-1) meanings are just my best guess.<br/><br/>**Int2** is a reference to the string found at that number's location in a uni file.<br/>\*\* See section 5 near the end of this document for details on UNI strings. |

Examples of use in code and on the screen:

**Example 1:**  
CODE:  
```
    print("Kyle!  Get that babelfish out of your ear!");
```
RESULT:
```
    <top of screen>
    Kyle!  Get that babelfish out of your ear!
```

**Example 2:**  
CODE:
```
    print("No the other one!  Can't you feel - naskoota wonkapee? Dah fit, dah fit.  Dung Jedi...");  
    printVector(vectorSet(3.2, 4.5, 2.0));
```
RESULT:
```
    <top of screen>
    No the other one!  Can't you feel - naskoota wonkapee?  Dah fit, dah fit.  Dung Jedi...
    3.200  4.500  2.000
```

###4. JkString ... and what the heck is a concatanate?

The jkString series of commands store pieces of information in a
buffer (that's like the imaginary place where lost socks go, only you
can find what's put in a buffer), which can then be outputted as one
line at the top of the screen.  This process of gluing bits of
information together to make one string is called **concatanation**.  To
concatanate something means to join it on at the **end** of something
else.

It's important to note that a string is just a name for a
grouping of letters and numbers, only the numbers in a string have no
"value" and as such can't be used in math functions or to represent
numerical data.  Remember that a number type symbol like an integer or a
flex can be converted into a string, but a string number can't be
converted into a numerical value.  (at least not in JK...)

JKString commands require a little more thought and a little
more coding to make them work right.  It's a three step process:

1. Clear the buffer of anything leftover from a previous use
(neglecting this can be a real pain in the buffer..)  
2. Concatanate all your string bits  
3. Chill and serve....I mean, send your buffered string to the player's
screen.

 The following is a list of all the jkString commands and commands
related to this method of output:  

####jkString Output Formatting Functions</span>
|                                     |                                                                                             |
| ----------------------------------- | ------------------------------------------------------------------------------------------- |
| jkStringClear()                     | This clears the buffer, providing a blank space in which to create our string.  This should ALWAYS be executed before creating a string. |
| jkStringConcatAsciiString("string") | Similar to the Print("string") command, everything typed in quotations will be concatanated to the end of the string in the buffer. |
| jkStringConcatInt(**int**)          | This concatanates an **int**eger number or integer defined symbol to the end of the string. |
| jkStringConcatFlex(**flex**)        | This concatanates a **flex** number or flex defined symbol to the end of the string.        |
| jkStringConcatSpace()               | Creates a black hole in the string. <br/>I mean... <br/>This adds a single empty space to the end of the string.  Used to separate concatanated pieces so they aren't all squished together.  |
| jkStringConcatPlayerName(**int**)   | This concatanates a player's name to the string.  **Int** is the ID number of a player in multiplayer, but the concatanate that will be displayed, however, will be the actual player name, not the number.  The Id number is usually acquired using GetLocalPlayerThing() or get SourceRef() or another function like that. |
| jkStringConcatVector(**vector**)    | This concatanates a set of three decimal numbers to the string.  **Vector** represents a  vector symbol or the use of VectorSet(flexX, flexY, flexZ) to declare the vector. |
| jkStringConcatUNIString(**int**)    | This function concatanates a UNI string stored in a uni file to the currently buffered string.  The **int**eger here represents the ID number of a string stored in a UNI file, and concatanates that string to the buffered string.<br/>\*\* See section 5 near the end of this document for details on UNI strings. |
| jkStringOutput(int1, int2)          | This outputs the whole string currently stored in the jkString buffer to the screen.<br/><br/>**Int1** represents WHO receives the string.  This can be the ID number of a player, or in the case of a negative number, certain groups of players.  These numbers are the same as those used with jkPrintUniString().<br/><br/>**Int2** is most often represented as a (-1) in LEC examples, and as such, it is unknown at this time what it represents. I've tested this command with different values, positive and negative, with no apparent change in output. |
   
*GENERAL EXAMPLE:*  
CODE:
```
    jkStringClear();
    jkStringConcatAsciiString("There are");
    jkStringConcatSpace();
    jkStringConcatInt(3);
    jkStringConcatAsciiString(" apples,");
    jkStringConcatSpace();
    jkStringConcatInt(2);
    jkStringConcatSpace();
    jkStringConcatAsciiString("of them are red.");
    jkStringOutput(-3, -1);
```
RESULT:
```
    <top of screen>
    There are 3 apples, 2 of them are red.
```

So if we had some code that calculated the number of apples and
another that calculated how many of those are red, we could display
those calcualations to the player in a very comprehensive way.  On a
creative note, this is an excellent way of creating special use cogs
that can communicate useful data to the player, like a rangefinder for
example.  Using jkString to format output can be much more work than
using simple print() commands, but the results can also be much more
meaningful and efficient.

###5. UNI strings and other sexy underwear
   
Storing and calling strings from UNI files is a very organized
and efficient method of displaying output to the screen, and has an
added benefit as detailed in section 7 (don't read it yet\!  I bet you
just did, too...).  What type of cog you are creating determines which
UNI file you need to store your string in.

Generally, UNI files store and identify strings that will be
displayed to the computer screen at some point during the JK
experience.  These strings vary in purpose from the text you see in all
the game menus, to some of the yellow text that appears at the top of
the screen when playing the game.  There are a number of UNI files, each
having at least one purpose - but for the sake of cog coding, we only
have to consider two such files:  JKSTRINGS.UNI and COGSTRINGS.UNI.

JKSTRINGS.UNI stores strings that are used in every *episode*,
and for every time you run JK (or MotS).  This includes:

>all menu text  
>all keyboard command text, viewable in the Setup/Control/Keyboard menu  
>all cutscene text  
>all UNI strings called by cogs found in ITEMS.DAT  
   
...and some other not-so-important stuff :-)

COGSTRINGS.UNI stores strings that are used only in *specific*
episodes (ie there is a different  cogstrings.uni file included with
every different episode), and includes:  
   
>all GOAL text for levels in that episode  
>all load-screen text for levels in that episode  
>all other cog-related UNI strings for levels in that episode

If your cog is linked to any BIN (bins and their cogs are
defined in ITEMS.DAT), then your UNI strings called in that cog must be
located in JKSTRINGS.UNI.  An example of this would be item\_bacta.cog,
which when activated prints:

>"Using Bacta"

If, on the other hand, you wanted to print a UNI string from a
cog not found in ITEMS.DAT, that string would have to be located in
COGSTRINGS.UNI.  For example, in the last level of MotS, Kyle says:

>"I know your intentions are to save me, Mara... but it's far too
late now."  
   
This string, used in a triggered-event cog in the single player
episode, is stored in the COGSTRINGS.UNI for that episode.

Cog strings are identified and stored in a very specific way. 
Thankfully, the "specific way" is essentially the same amongst all UNI
files.  Examine the following taken from JKSTRINGS.UNI:
```
    "COG_00250"    0 "Using Bacta"
```

There's three parts to this line:  
 
|             |        |               |
| ----------- | ------ | ------------- |
| "COG_00250" | 0      | "Using Bacta" |
| ID TAG      | SPACER | STRING        |
| The ID tag for cog strings ALWAYS follows the format<br/><br/>"COG_#####"<br/><br/>where ##### is a five digit number that is unique for every string in the file.  This number is the integer that is used in the PrintUniString() and jkStringConcatUNIString() to identify which UNI string to work with. | This is just a spacer.  It has to be there, and is always just a single, lonely 0 between the ID TAG and the STRING. | This is the text that we want to be associated with this particular ID tag. |

**Example:**  
The following prints a string stored in JKSTRINGS.UNI from within the
activated: message of item\_bacta.cog:

CODE:  
In JKSTRINGS.UNI:  
```
    "COG_00**280**"    0    "This is my very special text."
```

In item\_bacta.cog:
```
    Activated:  
        PrintUniString(-3, **280**);       <=== no leading 0's required before 280  
        ....
```
*OR*
```
    Activated:  
        jkStringClear();  
        jkStringConcatUniString(**280**);  
        jkStringOutput(-3,-1);  
        ....
```
RESULT:
```
    <top of screen>
    This is my very special text.
```
If this had been a brand new cog, not defined in ITEMS.DAT, the
string would have had to be stored and ID'd in COGSTRINGS.UNI.

###6. Size DOES matter: Making your text fit the screen

Strings stored in a UNI file and displayed using
PrintUniString() or jkStringConcatUniString() can display more
characters on one line (longer line of text on screen) than a string
displayed by the print() verb or by a JKStringConcatAsciiString() in the
code itself.  It seems the maximum CODED ascii string length is
determined by the screen resolution at the time the verb is executed.

For example:  
A long string using print() that is too long for 320x200 might
show up in 640x480.

BUT...

A long string called from a .UNI file with jkPrintUniString()
(or jkStringConcatUniString()) will **always** show up no matter how
long the string is.  If it is TOO long for the screen width however, you
will get some weird results (Try playing "Siege at Vol Kanst" in 320x200
:-)

###7. The End?  Really?

I've left out two commands on purpose -
jkStringConcatFormattedInt(int1, int2) and
jkStringConcatFormattedFlex(flex, int).  The reason is quite simple - I
don't fully understand what they do differently from jkStringConcatInt
and ConcatFlex.  I have tested these thoroughly using various integer
values for the second parameter to no avail - differing numbers produce
same results.  It IS known for sure that two arguments must be present
and that the second argument must be an integer, because in testing,
omitting an argument forced a null result from FormattedInt and a zero
decimal zero result from formatted flex.

Maybe they posess the key to unlocking all the cogging mysteries
out there - but for now they're not really all that important.

So, with that I bid you good cogging and look forward to seeing
some well versed and textually immaculate cogs\!

_____
MastaJedi
Project Leader  
JKRPG  
Jedi Knight Role Playing Group
