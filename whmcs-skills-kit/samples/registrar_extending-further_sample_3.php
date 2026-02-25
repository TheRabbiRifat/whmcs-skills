<?php

<form method="post" action="clientarea.php?action=domaindetails">
<input type="hidden" name="domainid" value="{$domainid}" />
<input type="hidden" name="modop" value="custom" />
<input type="hidden" name="a" value="reboot" />
<input type="submit" value="Reboot VPS Server" />
</form>