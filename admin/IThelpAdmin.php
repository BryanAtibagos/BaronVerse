<?php 
// header navbar
include_once __DIR__ . '/../header.php';   
// require_once __DIR__ . '/../IT/tablepackage.php';   
// 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
  .collapsibles {
    background-color: #ebeeee;
    color: black;
    cursor: pointer;
    padding: 18px;
    margin: 3px;
    padding-left: 0px;
    width: 100%;
    border-radius: 4px;
    border: none;
    /* border: 1px solid gray; */
    text-align: left;
    outline: none;
    font-size: 15px;
  }

  .act,
  .collapsibles:hover {
    /* background-color: #292A7C; */
    color: black;
  }

  .down {
    display: none;
  }

  .act .down {
    display: inline;
  }

  .act .right {
    display: none;
  }

  .content {
    border-left: 5px solid #292A7C;
    transition: all 2s ease;
    padding: 0 18px;
    display: none;
    overflow: hidden;
    background-color: #f1f1f1;
  }
</style>
<body class="body">
  <br><br><br><br><br>
  <div class="nav-ticketing">
    <div class="dashboard-list" style="padding-left:14px;">
      <ul class="dashboard-ul">
        <li><a href="IThelpAdmin.php"
            style="font-size:30px;  color:#00a037; font-weight:500;  border-bottom:green solid 2px;">FAQ's</a></li>
        <li><a href="qanda.php" style="font-size:30px;">Q&A</a></li>
      </ul>
    </div>
  </div>
  <br><br>
  <div style="padding:0 40px 0 40px;">
    <h4>General hardware issues</h4>
    <!--  -->
    <button type="button" class="collapsibles">
      <ul style="display:flex; list-style:none; margin:auto;justify-content: space-between;">
        <li>My computer freezes or is behaving strangely</li>
        <li>
          <i class="right fa-solid fa-plus"></i>
          <i class="down fa-solid fa-minus"></i>
        </li>
      </ul>
    </button>
    <div class="content">
      <ul>
        <li>Try restarting your computer. Many basic problems can be resolved easily and quickly this
          way.</li>
        <li>Press the Ctrl & Alt & Del keys on your keyboard together at the same time. This should
          bring up a menu that will allow you to run Task Manager. In Task Manager, switch to the Applications tab.
          Highlight any programs with the status 'Not Responding' and choose End Task. You may be asked to confirm if
          you
          want to end the unresponsive program, so choose Yes. Do this for all programs that are not responding.</li>
        <li>If all else fails and you cannot shutdown/restart your computer, then hold down the power
          button on the machine until it forcibly turns off. Wait a few seconds and then turn it back on again.</li>
      </ul>
    </div>
    <!--  -->
    <!--  -->
    <button type="button" class="collapsibles">
      <ul style="display:flex; list-style:none; margin:auto;justify-content: space-between;">
        <li>My computer doesn't power up</li>
        <li>
          <i class="right fa-solid fa-plus"></i>
          <i class="down fa-solid fa-minus"></i>
        </li>
      </ul>
    </button>
    <div class="content">
      <ul>
        <li>Check that all the cables are securely plugged into the back of the machine and the monitor.</li>
        <li>Check that the power cables are plugged into a power socket and the socket has been turned on.</li>
        <li>Try using a different power socket or, if you are using a power extension strip, plug the power cable
          directly into a power socket in the wall.</li>
        <li>Replace the power cable with one that you know works.</li>
        <li>With laptops, try removing the power cable and the battery. Hold down the power button for about ten
          seconds, and then plug the battery and power cable in again. Press the power button to see if it switches on.
        </li>
      </ul>
    </div>
    <!--  -->
    <button type="button" class="collapsibles">
      <ul style="display:flex; list-style:none; margin:auto;justify-content: space-between;">
        <li>The mouse or keyboard has stopped working</li>
        <li>
          <i class="right fa-solid fa-plus"></i>
          <i class="down fa-solid fa-minus"></i>
        </li>
      </ul>
    </button>
    <div class="content">
      <ul>
        <li>If you're using a wired mouse or keyboard, make sure it's correctly plugged into the computer.</li>
        <li>If you're using a wireless mouse or keyboard, make sure it's turned on and that its batteries are
          charged.</li>
      </ul>
    </div>
    <button type="button" class="collapsibles">
      <ul style="display:flex; list-style:none; margin:auto;justify-content: space-between;">
        <li>The screen is blank</li>
        <li>
          <i class="right fa-solid fa-plus"></i>
          <i class="down fa-solid fa-minus"></i>
        </li>
      </ul>
    </button>
    <div class="content">
      <ul>
        <li>The computer may be in Sleep mode. Click the mouse or press any key on the keyboard to wake it.</li>
        <li>Make sure the monitor is plugged in and turned on.</li>
        <li>Make sure the computer is plugged in and turned on</li>
        <li>If you're using a desktop, make sure the monitor cable is properly connected to the computer tower
          and the monitor.</li>
      </ul>
    </div>
  </div>
  <br>
  <div style="padding:0 40px 0 40px;">
    <h4>General software issues</h4>
    <button type="button" class="collapsibles">
      <ul style="display:flex; list-style:none; margin:auto;justify-content: space-between;">
        <li>An application is frozen</li>
        <li>
          <i class="right fa-solid fa-plus"></i>
          <i class="down fa-solid fa-minus"></i>
        </li>
      </ul>
    </button>
    <div class="content">
      <ul>
        <li>Sometimes an application may become stuck, or frozen. When this happens, you won't be able to close the
          window
          or click any buttons within the application.</li>
        <li>Force quit the application. On a PC, you can press (and hold) Ctrl+Alt+Delete (the Control, Alt,
          and Delete keys) on your keyboard to open the Task Manager. On a Mac, press and hold Command+Option+Esc. You
          can
          then select the unresponsive application and click End task (or Force Quit on a Mac) to close it.</li>
        <li>Restart the computer. If you are unable to force quit an application, restarting your computer will
          close all open apps.</li>
      </ul>
    </div>
    <button type="button" class="collapsibles">
      <ul style="display:flex; list-style:none; margin:auto;justify-content: space-between;">
        <li>An application is running slowly</li>
        <li>
          <i class="right fa-solid fa-plus"></i>
          <i class="down fa-solid fa-minus"></i>
        </li>
      </ul>
    </button>
    <div class="content">
      <ul>
        <li>Close and reopen the application.</li>
        <li>Update the application. To do this, click the Help menu and look for an option to check for
          Updates. If you don't find this option, another idea is to run an online search for application updates.</li>
      </ul>
    </div>
  </div>
  <br>
  <!--  -->
  <div style="padding:0 40px 0 40px;">
    <h4>Speeding up a slow computer</h4>
    <button type="button" class="collapsibles">
      <ul style="display:flex; list-style:none; margin:auto;justify-content: space-between;">
        <li>Run fewer programs at the same time</li>
        <li>
          <i class="right fa-solid fa-plus"></i>
          <i class="down fa-solid fa-minus"></i>
        </li>
      </ul>
    </button>
    <div class="content">
      <p>Don't have too many programs running at the same time. Each running program consumes a bit of the system's
        resources. Have multiple open windows for the same program (e.g. having three Word documents open) also lowers
        resources as each window takes up a bit of memory and processing power.</p>

      <p>If you are not using an open file or program, close it so that the files/programs you are working in can speed
        up a little.</p>
    </div>
    <button type="button" class="collapsibles">
      <ul style="display:flex; list-style:none; margin:auto;justify-content: space-between;">
        <li>Uninstall unnecessary programs</li>
        <li>
          <i class="right fa-solid fa-plus"></i>
          <i class="down fa-solid fa-minus"></i>
        </li>
      </ul>
    </button>
    <div class="content">
      <p>You may have many programs install on your computer that you never use or don't need. Uninstalling these
        programs can free up hard disk space and speed up your computer.</p>
      <ul>
        <li>Click on Start and then Control Panel.</li>
        <li>In Windows XP click on 'Add/Remove Programs'. In Windows Vista/7 click on 'Programs and features'.</li>
        <li>Select the program you no longer need and click on Remove/Uninstall.</li>
      </ul>
      <p>Important Note: Be careful what you uninstall, as it may be an important program or system utility. If you are
        unsure about what is safe to remove or not, please ask a member of DIDE IT.</p>
    </div>
  </div>
  <br><br>
</body>

</html>
<script>
  var coll = document.getElementsByClassName("collapsibles");
  var i;
  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
      this.classList.toggle("act");
      var content = this.nextElementSibling;
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    });
  }
</script>