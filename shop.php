<?php

echo '<div>';
foreach ($products as $prod) {
    echo
        '<a href="#">'.
        '<div class="product">' .
        '<div class="main-text">' .

        $medtypes[array_search($prod['medType'], array_column($selltypes, 'myType'))]['name'] . "<br>" .
        $prod['name'] . "<br>" .
        '<img src="' . $prod['imgLink'] . '" alt="" width="150" height="150">' . "<br>" .
        $prod['price'] . " грн." . "<br>" .
        '</div>'.
    '<div class="extra-text" id="smth">' .
        (($prod['bySale']) ? 'Со скидкой' : 'Без скидки') . '<br>' .
        "Серийный номер: ".$prod['serialNum'] . "<br>" .
        "Цвет: ".$color[array_search($prod['deviceColor'], array_column($color, 'color'))]['name'] . "<br>" .
        "Дата создания: ".((isset($prod['releaseYear'])) ? $prod['releaseYear'] : "Неизвестно") . "<br>" .
        "Наличие: ".((isset($prod['avQuantity'] )) ? $prod['avQuantity']  : "Нет в наличии"). "<br>" .
        "Форма производства: ".$prod['form'] . "<br>" .
        '</div>' .
        '</div></a>';
}
echo '</div>';
?>