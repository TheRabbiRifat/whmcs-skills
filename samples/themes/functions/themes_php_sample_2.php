<?php

<p>The fixed value is {$fixedValue}.</p>

{if $userSpecificValue && $anotherUserOnlyValue}
    <p>I also have this {$userSpecificValue} and {$anotherUserOnlyValue} to show you.</p>
{/if}