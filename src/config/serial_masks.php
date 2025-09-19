<?php

return [
    'patterns' => [
        // NAAAAAANAA → 2BHHHHA8BB, 4GGHHHI2JJ
        '/^[0-9][A-Z]{6}[0-9][A-Z]{2}$/' => 'NAAAAAANAA',

        // NXXAAXZXaa → 5YY9D-A8ff
        '/^[0-9][A-Z0-9]{2}[0-9][A-Z]-[A-Z0-9][a-z]{2}$/' => 'NXXAAXZXaa',

        // NAAAAXZXXX → 9ZZZD-HJYU
        '/^[0-9][A-Z]{4}-[A-Z0-9]{4}$/' => 'NAAAAXZXXX',

        // расширенный без дефиса → 1CCDDDE9FF
        '/^[0-9][A-Z]{4}[0-9][A-Z]{2}$/' => 'NAAAANAA',

        // вариант с символами @ - _ → 6QQ7E@K2gg
        '/^[0-9][A-Z0-9]{2}[0-9][A-Z][-_@][A-Z0-9][0-9][a-z]{2}$/' => 'NXXAAZXNaa',

        // вариант с цифрой и дефисом → 8WWW9-YTGR, 0VVV0-XPKL
        '/^[0-9][A-Z]{3}[0-9]-[A-Z0-9]{4}$/' => 'NAAAAXXXX',

        // удлинённый вариант → 3EEFFFFF1GG
        '/^[0-9][A-Z0-9]{2}[A-Z]{5}[0-9][A-Z]{2}$/' => 'NXXAAAAANAA',

        // вариант с дефисом + нижний регистр → 7TT8X-Z5hh
        '/^[0-9][A-Z0-9]{2}[0-9][A-Z0-9]-[A-Z][0-9][a-z]{2}$/' => 'NXXNX-ZNaa',
    ],
];
