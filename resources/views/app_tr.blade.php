<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>tr</title>
        <link rel="icon" type="" href="">
        
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">

        <style>
            /* MediumEditor モーダル内で使用する場会、デフォルトだとモーダルのz-indexが勝ってしまうため */
            .medium-editor-toolbar {
                z-index: 2500;
            }
        </style>
    </head>
    <body>
        <div>
            test
        </div>
        <div id="app">
        </div>
        <script src="{{ mix('js/app-tr.js') }}"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
    </body>
</html>
