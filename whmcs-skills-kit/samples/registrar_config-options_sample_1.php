<?php
function yourmodulename_getConfigArray($params)
{
    return array(
        "username" => array (
            "FriendlyName" => "UserName",
            "Type" => "text", # Text Box
            "Size" => "25", # Defines the Field Width
            "Description" => "Textbox",
            "Default" => "Example",
        ),
        "password" => array (
            "FriendlyName" => "Password",
            "Type" => "password", # Password Field
            "Size" => "25", # Defines the Field Width
            "Description" => "Password",
            "Default" => "Example",
        ),
        "usessl" => array (
            "FriendlyName" => "Enable SSL",
            "Type" => "yesno", # Yes/No Checkbox
            "Description" => "Tick to use secure connections",
        ),
        "package" => array (
            "FriendlyName" => "Package Name",
            "Type" => "dropdown", # Dropdown Choice of Options
            "Options" => "Starter,Advanced,Ultimate",
            "Description" => "Sample Dropdown",
            "Default" => "Advanced",
        ),
        "disk" => array (
            "FriendlyName" => "Disk Space",
            "Type" => "radio", # Radio Selection of Options
            "Options" => "100MB,200MB,300MB",
            "Description" => "Radio Options Demo",
            "Default" => "200MB",
        ),
        "comments" => array (
            "FriendlyName" => "Notes",
            "Type" => "textarea", # Textarea
            "Rows" => "3", # Number of Rows
            "Cols" => "50", # Number of Columns
            "Description" => "Description goes here",
            "Default" => "Enter notes here",
        ),
    );
}