How to add your own custom GUI for Cpanel

1 Create the following file structure:
  /modules/system/class/gui/mygui/mygui.php

2 In the mygui.php:

    xoops_load("gui", "system");

    class XoopsGuiMygui extends XoopsSystemGui
    {
        function validate()
        {
            // Code to validate the GUI
            //return true or false;
        }

        function header()
        {
            // Generate the header
        }

        function footer()
        {
            // Generate the footer
        }

        function flush()
        {
            // Flush cached configs, optional
        }
    }

3 Or refer to /modules/system/class/gui/thadmin/thadmin.php