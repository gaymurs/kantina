<?php
// made by https://gitlab.com/nihodi or @nihodi
class automagic
{
    public static function automagicForm(array $dataDefinition, string $method, string $action): string
    {
        $content = "";

        foreach ($dataDefinition as $namingKey=>$formControl) {
            $label = $formControl["label"] ?? ucfirst(str_replace(["-", "_"], " ", $formControl["name"])) . ":";
            if (isset($formControl["name"])) {
                $name = $formControl["name"];
            } else {
                $name = $namingKey;
            }

            $attributes = "";
            foreach (array_filter($formControl, function ($key) {
                return $key !== "label" && $key !== "options";
            }, ARRAY_FILTER_USE_KEY) as $key => $value) {
                $attributes .= " $key='$value'";
            }

            switch ($formControl["type"]) {
                case "select":
                    $options = "";

                    foreach ($formControl["options"] as $option) {
                        $selectValue = "";
                        if (!is_array($option)) {
                            $value = $option;
                            $display = $option;
                            if (isset($formControl["value"])) if ($formControl["value"] === $option) {
                                $selectValue = " selected='selected' ";
                            }
                        } else {
                            $value = $option["value"];
                            $display = $option["display"];
                            if (isset($formControl["value"])) if ($formControl["value"] === $option["value"]) {
                                $selectValue = " selected='selected' ";
                            }
                        }

                        $options .= "<option value='$value' $selectValue >$display</option>";
                    }

                    $control = "<select id='$name-input' $attributes>$options</select>";

                    break;

                case "checkbox":
                    $checked = "";
                    if (isset($formControl["checked"])) {
                        $checked = "checked";
                    }
                    $control = "<input id='$name-input' $attributes $checked >";
                    break;

                default:
                    $control = "<input id='$name-input' $attributes>";
                    break;

            }


            if ($formControl["type"] !== "hidden")
                $content .= "<label for='$name-input'>$label</label>";
            $content .= $control;
        }

        return "
            <form action='$action' method='$method'>
                $content
                <button type='submit'>Submit</button>
            </form>";
    }

    public static function automagicTable(array $data): string
    {
        if ($data === []) return "<h1>Table is Empty</h1>";
        $content = "";

        // headers
        $headers = "";
        foreach ($data as $i) {
            foreach ($i as $key => $value) {
                $uppercase = ucfirst(str_replace("-", " ", $key));
                $headers .= "<th>$uppercase</th>";
            }
            break;
        }

        $content .= "<tr>$headers</tr>";

        foreach ($data as $row) {
            $content .= "<tr>";
            foreach ($row as $value) {
                $content .= "<td>$value</td>";
            }
            $content .= "</tr>";
        }

        return "<table>$content</table>";
    }
}