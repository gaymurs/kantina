<?php
function getAllForms () {
    return [
        "meny" => [
            [
                "type" => "number",
                "name" => "id",
            ],
            [
                "type" => "text",
                "name" => "meny",
            ],
            [
                "type" => "text",
                "name" => "innhold",
            ],
            [
                "type" => "number",
                "name" => "pris",
            ],
        ],
    ];
}