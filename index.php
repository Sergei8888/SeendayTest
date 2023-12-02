<?php 
global $pj_arr, $ini_arr;

// TWorks(127);

// Получаем переменную 
$pName = $pj_arr['page'][$pj_arr['page_name']];
$client = $pj_arr['page']['GET']['client'];
$psid   = $pj_arr['page']['GET']['psid'];
if ($client == 1) { $c_hid = 'd_n'; $dop_url = 'client=1&psid=' . $psid . '&'; }

$type_page = $pj_arr['page']['GET']['type'];

if ($type_page == 'ps' || $type_page == 'alb') {
    $link_back = '/my?section=photosession';
} else {
    $link_back  = '/';
}

?>

<main class="main" data-fixed="fixed">
    <btn-group data-type="mobile">
        <a href="<?= $link_back; ?>" class="button button--size_l" data-color="gray">Назад</a>
    </btn-group>
    <wrapper-sort>
        <!-- Фиксируем бfлок -->
        <global-sort>
            <?php if($pj_arr['user']['acc_type'] >= 100) : ?>
            <div class="block">
            <!-- Проверяем является ли пользователь менеджером, если да, то выводим расширенный функционал -->
                <?php if ($pj_arr['user']['acc_type'] >= 100) : 

                

                // $pj_arr['M']['date'] = 'date_period';
                // $pj_arr['M']['input_attr'] = 'maxlength="10" placeholder="Выберите период" value="' . $value_input_date . '" autocomplete="off"';
                // Подключение компонента блока календаря
                // file_connection($pj_arr['projects.pages'] . '/' . $pj_arr['page'][1]['name'] . '/_section/_components/block-date.comp', 'include');
                ?>

                <block-date>
                <?php
                $pj_arr['M']['multitaskinput']['date'] = 'date_period';
                $pj_arr['M']['multitaskinput']['input']['attr'] = 'data-status="0" maxlength="10" placeholder="Выберите период" value="' . $value_input_date . '" autocomplete="off"';
                $pj_arr['M']['multitaskinput']['css_attr'] = 'multitaskinput_period_1'; 
                $pj_arr['M']['multitaskinput']['css']['attr']['main'] = 'w100';
                $pj_arr['M']['multitaskinput']['css']['attr']['input'] = 'text-center';
                // Подключение компонента блока календаря
                file_connection($pj_arr['projects.pages'] . '/_components/multitaskinput.comp', 'include');
                ?>
                </block-date>
                      
                <!-- Поля сортировки -->
                <wrapper-sort-fields>
                    <!-- ВВодим номер заказа --> 
                     <sort-fields class="sort-fields">
                        <!-- Открыть кнопки сортировки -->
                        <button id="open_fields_sort" class="button sort-fields__btn" data-color="gray" onclick="Manager_Orders.open_sort_block(this);"><i class="far fa-filter"></i></button>
                        <div class="sort-fields__textfield sort-fields__textfield_order" id="type_search_input">
                            <span data-type="order_number">Номер заказа</span>
                            <input id="input_search" class="input sort-fields__input" data-type="order_number" type="text" placeholder="Введите номер заказа"/>
                        </div>    
                        <!-- Кнопка поиска -->
                        <button id="search_on_fields" class="button sort-fields__btn" data-color="purple"  onclick="Manager_Orders.online_order_search();"><i class="fas fa-search"></i></button>
                        <a id="hidden_sub_search" data-show="0" href="/"></a>
                    </sort-fields>
                    <!-- Кнопки сортировки --> 
                    <sort-search class="sort-search d_n">
                        <div class="sort-search__type" data-type="order_number" onclick="Manager_Orders.choose_sort_type(this);">Номер заказа</div>
                        <div class="sort-search__type" data-type="psid" onclick="Manager_Orders.choose_sort_type(this);">Номер фотосессии</div>
                        <div class="sort-search__type" data-type="client_id" onclick="Manager_Orders.choose_sort_type(this);">Клиент ID</div>
                        <div class="sort-search__type" data-type="phone" onclick="Manager_Orders.choose_sort_type(this);">Телефон</div>
                        <div class="sort-search__type" data-type="email" onclick="Manager_Orders.choose_sort_type(this);">Email</div>
                        <div class="sort-search__type" data-type="other" onclick="Manager_Orders.choose_sort_type(this);">Плательщик, ребенок</div>
                    </sort-search>
                </wrapper-sort-fields>
                <?php endif; ?>

                <wrapper-sort-order data-show="1">
                    <sort-order class="sort-order">
                        <sort-order-sub class="sort-order__sub" data-active="active" status="1" el="all" onclick="Manager_Orders.sorting_orders(this);" data-content="Все заказаы">
                            <span class="sort-order__title">все</span>
                        </sort-order-sub>
                        <sort-order-sub class="sort-order__sub" status="1" el="clients" onclick="Manager_Orders.sorting_orders(this);" data-content="Заказы Заказчика">
                            <i class="far fa-crown"></i>
                        </sort-order-sub>
                        <sort-order-sub class="sort-order__sub" data-id="sorting" status="1" el="unpaid" onclick="Manager_Orders.sorting_orders(this);" data-content="Не оплаченные заказы">
                            <i class="far fa-thumbs-down"></i>
                        </sort-order-sub>
                        <sort-order-sub class="sort-order__sub" data-id="sorting" status="1" el="paid" onclick="Manager_Orders.sorting_orders(this);" data-content="Оплаченные заказы">
                            <i class="far fa-thumbs-up"></i>
                        </sort-order-sub>
                        <sort-order-sub class="sort-order__sub" data-id="sorting" status="1" el="in_work" onclick="Manager_Orders.sorting_orders(this);" data-content="Заказы в работе">
                            <i class="far fa-briefcase"></i>
                        </sort-order-sub>
                        <sort-order-sub class="sort-order__sub" data-id="sorting" status="1" el="unload" onclick="Manager_Orders.sorting_orders(this);" data-content="Выгруженные заказы">
                            <i class="far fa-cloud-upload"></i>
                        </sort-order-sub>
                        <sort-order-sub class="sort-order__sub" data-id="sorting" status="1" el="delivered" onclick="Manager_Orders.sorting_orders(this);" data-content="Полученные заказы">
                            <i class="far fa-truck"></i>
                        </sort-order-sub>
                        <?php if ($pName['owner_acq'] == 'seenday') : ?>
                        <sort-order-sub class="sort-order__sub" data-id="sorting" status="1" el="disbursement" onclick="Manager_Orders.sorting_orders(this);" data-content="Выплаченные заказы">
                            <i class="far fa-money-bill-alt"></i>
                        </sort-order-sub>
                        <?php endif; ?>
                    </sort-order>
                </wrapper-sort-order>
            </div>
            <?php endif; ?>


            <div class="block search-orders">
                 <!-- Список фильтра по году -->
                <div class="select-filter" data-type="search_year" onclick="Manager_Orders.open_lists(this);">
                    <input type="hidden" data-type="i_search_year">
                    <ul class="block select-lists select-filter__lists" data-type="search_year" data-show="0">
                        <li class="select-lists__item default" data-type="search_year" onclick="Manager_Orders.select_lists_item(this);"><a href="#">Выберите год</a></li>

                        <?php 
                        krsort($pName['search']);

                        foreach ($pName['search'] as $key => $value) :
                        ?>
                        <li class="select-lists__item" data-type="search_year" data-value="<?php echo $key; ?>" onclick="Manager_Orders.select_lists_item(this);">
                            <a href="#"><?php echo $key; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <!--Активное значение фильтрации -->
                    <span class="select-filter__active" data-type="search_year">Выберите год</span>
                    <div class="select-filter__icon">                  
                    </div>
                </div> 
                <!-- Cписок фильтра по типу -->
                <div class="select-filter" data-type="search_type" data-show="0" onclick="Manager_Orders.open_lists(this);">
                    <input type="hidden" data-type="i_search_type">
                    <ul class="select-lists block select-filter__lists" data-type="search_type" data-show="0">
                         <li class="select-lists__item default" data-type="search_type" onclick="Manager_Orders.select_lists_item(this);"><a href="#">Выберите тип</a></li>

                    <?php 
                    foreach ($pName['search'] as $key => $value) : 
                        foreach ($pName['search'][$key] as $key2 => $value2) :
                          
                    ?>
                        <li class="select-lists__item" data-type="search_type"  data-value="<?php echo $key2; ?>" data-flag="<?php echo $key; ?>" onclick="Manager_Orders.select_lists_item(this);">
                            <a href="#"><?= $key2; ?></a>
                        </li>
                    <?php 
                        endforeach;
                    endforeach; 
                    ?>
                    </ul>
                    <!--Активное значение фильтрации-->
                    <span class="select-filter__active" data-type="search_type">Выберите тип</span>
                    <div class="select-filter__icon">                     
                    </div>
                </div> 
                 <!--Список фильтра номер учреждения-->
                <div class="select-filter" data-type="search_number" data-show="0" onclick="Manager_Orders.open_lists(this);">
                    <input type="hidden" data-type="i_search_number">
                    <ul class="select-lists block select-filter__lists" data-show="0"  data-type="search_number">
                         <li class="select-lists__item default" data-type="search_number" onclick="Manager_Orders.select_lists_item(this);">
                            <a href="#">Выберите место проведения</a>
                        </li>
                    <?php 
                    foreach ($pName['search'] as $key => $value) : 
                        foreach ($pName['search'][$key] as $key2 => $value2) :
                            uksort($pName['search'][$key][$key2], 'strnatcmp');
                            foreach ($pName['search'][$key][$key2] as $key3 => $value3) :
                    ?>
                        <li class="select-lists__item" data-value="<?= $key3; ?>" onclick="Manager_Orders.select_lists_item(this);" data-type="search_number" data-flag="<?php echo $key . '_' . $key2; ?>">
                            <a href="#"><?php echo $key3; ?></a>
                        </li>
                    <?php 
                            endforeach;
                        endforeach;
                    endforeach; 
                    ?>
                    </ul>
                    <!--Активное значение фильтрации--> 
                    <span class="select-filter__active"  data-type="search_number">Выберите место проведения</span>
                    <div class="select-filter__icon">                     
                    </div>
                </div> 
                 <!--Список фильтра группа / класс -->
                <div class="select-filter" data-type="search_group" data-show="0" onclick="Manager_Orders.open_lists(this);">
                    <input type="hidden" data-type="i_search_group">
                    <ul class="select-lists block select-filter__lists" data-show="0" data-type="search_group">
                        <li class="select-lists__item default" data-type="search_group" onclick="Manager_Orders.select_lists_item(this);">
                            <a href="#">Выберите для кого</a>
                        </li>
                        <?php 
                        foreach ($pName['search'] as $key => $value) : 
                            foreach ($pName['search'][$key] as $key2 => $value2) :
                                foreach ($pName['search'][$key][$key2] as $key3 => $value3) :
                                    uksort($pName['search'][$key][$key2][$key3], 'strnatcmp');
                                    foreach ($pName['search'][$key][$key2][$key3] as $key4 => $value4) :
                        ?>
                        <li class="select-lists__item" data-type="search_group" data-flag="<?php echo $key . '_' . $key2 . '_' . $key3; ?>" data-value="<?= $key4; ?>" onclick="Manager_Orders.select_lists_item(this);">
                            <a href="#"><?php echo $key4; ?></a>
                        </li>
                        <?php
                                    endforeach;
                                 endforeach;
                            endforeach;
                        endforeach; 
                        ?>
                    </ul>
                    <!--Активное значение фильтрации-->
                    <span class="select-filter__active" data-type="search_group">Выберите для кого</span>
                    <div class="select-filter__icon">                     
                    </div>
                </div> 
                <div class="search-orders__btn justify-content-between">
                    <a class="button button--size_l" data-color="purple" href="/manager?section=orders" onclick="Manager_Orders.run_search();">Показать</a>                        
                    <a href="/manager?section=orders" class="button button--size_l" data-color="gray">Сбросить</a>
                </div>
                <p class="text 10">Обычный вывод показывает 250 заказов, чтобы снять ограничение и показать до 5000 заказов. Надо выбрать год.</p>
            </div>

            <?php if ($pName['is_s_k_alb'] == '1') : ?>
            <notice data-show="1" class="notice d_i-f base-half-gap align-items-center text-10 text-left content-box-shadow" data-color="very-light-blue">
                <div><i class="fas fa-lightbulb-on text" data-color="blue"></i></div>
                <div>Для того чтобы показать табличку с информацией по всей <b class="text-block__bold">Школе</b> или <b class="text-block__bold">Детскому саду</b>, Вам надо обазательно выбрать только 3 пункта: <b class="text-block__bold">Год</b>, <b class="text-block__bold">Тип</b>, <b class="text-block__bold">Место проведения</b>.<br>Для того, чтобы показать информацию по <b class="text-block__bold">Альбому Ш/ДС</b>, Вам надо обазательно выбрать все 4 пункта
                </div>
            </notice>
            <?php 
            endif;

            if ($pName['school']['flag'] == 3 && ($pName['orders'][0]['ps_type'] == 's' || $pName['orders'][0]['ps_type'] == 'k')) : ?>
            <wrapper-order-total-data-mobile>
                <div class="block">
                    <div class="order-total-data text-12">
                        <!-- <notice class="notice base-half-margin-bottom" data-color="gray">Собирается с 01.09.[выбранный год] по <br>31.08.[следующий год]</notice> -->
                        <?php
                        switch ($pName['orders'][0]['ps_type']) {
                            case 's' : $str = 'Школа №'; break;
                            case 'k' : $str = 'Детский сад №'; break;
                        }

                        if ($pName['school']['paid']['many'] < 1) { $pName['school']['paid']['many'] = 0; }

                        $start_year = get_date('d.m.Y', $pName['start_year']);
                        $finish_year = get_date('d.m.Y', $pName['finish_year']);

                        if ($pName['school']['paid']['receiving'] < 1) { $pName['school']['paid']['receiving'] = 0; }
                        if ($pName['school']['paid']['disbursement'] < 1) { $pName['school']['paid']['disbursement'] = 0; }
                        if ($pName['school']['paid']['sum_payout'] > 1) { $pName['school']['paid']['sum_payout'] = 0; }
                        if ($pName['school']['paid']['sum_acq'] < 1) { $pName['school']['paid']['sum_acq'] = 0; }
                        if ($pName['school']['paid']['orders_acq'] < 1) { $pName['school']['paid']['orders_acq'] = 0; }
                        if ($pName['school']['paid']['sum'] < 1) { $pName['school']['paid']['sum'] = 0; }

                        ?>
                        <div>
                            <b class="text-block__bold">[<?= $pj_arr['page']['GET']['year']; ?>]: <?=  $str . ' ' . $pName['orders'][0]['value']; ?></b>
                        </div>
                        <div class="small-margin-top">Заказы за период: <b class="text-block__bold">с <?= $start_year; ?> по <?= $finish_year; ?></b></div>
                        <?php
                        // Подсчет % оплаченных
                        $one_persent = $pName['school']['orders'] / 100;
                        $total_percent = $pName['school']['paid']['many'] / $one_persent;
                        $total_percent = round($total_percent, 1);
                        ?>

                        <div>Всего / Оплачено: <b class="text-block__bold"><?php echo $pName['school']['orders'] . ' / ' . $pName['school']['paid']['many']; ?></b> (<?= $total_percent; ?>%)</div>

                        <?php 
                        // Проверяем были ли вообще оплаченные зказы
                        if ($pName['school']['paid']['many'] > 0) : 
                        ?>
                        <div>Оплачено заказов на сумму: <b class="text-block__bold"><?= $pName['school']['paid']['sum']; ?> руб.</b></div>
                        <div>Получено заказов: <b class="text-block__bold"><?= $pName['school']['paid']['receiving']; ?></b></div>

                        <div class="small-margin-top">Заказов по интернет эквайрингу: <b class="text-block__bold"><?= $pName['school']['paid']['orders_acq']; ?></b></div>
                        <div>На сумму по интернет-эквайрингу: <b class="text-block__bold"><?= $pName['school']['paid']['sum_acq']; ?> руб.</b></div>

                        <?php

                            if ($pName['school']['paid']['disbursement'] > 0) :
                            ?>
                            <div>Выплачено заказов: <b class="text-block__bold"><?= $pName['school']['paid']['disbursement']; ?></b></div>
                            <div>Выплачено: <b class="text-block__bold"><?= $pName['school']['paid']['sum_payout']; ?> руб.</b></div>
                            <?php
                            endif;
                        endif;

                        if (count($pName['school_photos']) > 0) :
                        ?>
                        <div class="base-half-margin-top">Оплаченные фотографии:</div>
                        <div class="order-total-data__sizes"> 
                            <?php 
                            $n = 0; 
                            foreach ($pName['school_photos'] as $key => $value) : 

                                if ($n % 2 == 0) { $margin_right = 'data-type="margin-right"'; } else { $margin_right = ''; }
                                echo '<p class=" text-10 sizes" ' . $margin_right . '><b class="text-block__bold">' . $key . '</b>: <span>' . $value . '</span></p>'; 
                                if ($n % 2 == 0) { echo '<br>'; $margin_right = ''; } else { $margin_right = 'data-type="margin-right"'; }
                                $n++;                  
                            endforeach; 
                            ?>
                        </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </wrapper-order-total-data-mobile>
            <?php endif; ?>

            <?php 
            // Показываем список для Альбомов
            if ($pName['ps_type'] == 'alb') : 
            ?>
            <wrapper-sort-order data-show="1">    
                <div class="block"> 
                    <div class="order-total-data text-12">
                        <div>
                            <div>Название: <span class="text-bold"><?= $pName['ps_title']; ?></span></div>
                        </div>
                        <div class="base-half-margin-top">
                            <div>Не оплаченные: <span class="text-bold"><?= $pName['orders_no_paid']; ?></span></div>
                            <div>Оплаченные: <span class="text-bold"><?= $pName['orders_paid']; ?></span></div>
                        </div>
                        <div class="base-half-margin-top">
                            <?php 
                            $list_i = 1;
                            foreach ($pName['list'] as $key => $list) : 
                                if ($list['closed'] != 1) {
                                    switch ($list['status']) {
                                        case 1 :
                                            if ($list['unload'] == 0) { 
                                                if ($list['in_work'] != 1) {   
                                                    $order_color = 'green'; 
                                                } else {    
                                                    $order_color = 'orange'; 
                                                    $list['status'] = 3;
                                                }
                                            } else {
                                                if ($list['receiving'] != 1) {   
                                                    $order_color = 'light-purple'; 
                                                    $list['status'] = 4;
                                                } else {   
                                                    $order_color = 'blue'; 
                                                }
                                            }
                                        break;
                                        case 2 : $order_color = 'gray'; $list['status'] = 2; break;
                                        case 7 : 
                                            if ($list['disbursement_date'] == '0') {
                                                $order_color = 'blue'; 
                                                $list['status'] = 7;
                                            } else { 
                                                $order_color = 'light-blue'; 
                                                $list['status'] = 8;
                                            }
                                        break;
                                    }
                                } else {
                                    $order_color = 'red'; 
                                    $list['status'] = 0;
                                }

                                if ($pName['list_sort'] == 'child') { $list_data = $list['fi_child']; }
                                if ($pName['list_sort'] == 'payer') { $list_data = $list['fio_payer']; }
                            ?>
                            <div data-id="alb_list" sort-status="<?= $list['status']; ?>" client-status="<?= $list['client']; ?>">
                                <div class="d_i-f base-half-gap w100">
                                    <div><?= $list_i ?>.</div>
                                    <div class="text-bold text" data-color="<?= $order_color; ?>"><?= $list['oid']; ?></div>
                                    <div>
                                        <div>
                                            <?php if ($list['client'] == 1) : ?>
                                            <i class="far fa-crown"></i> 
                                            <?php endif; ?>
                                            <?= $list_data; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php   
                                $list_i ++;
                            endforeach; 
                            ?>
                        </div>
                    </div>
                </div>
            </wrapper-sort-order>
            <?php endif; ?>

        </global-sort>
    </wrapper-sort>



    <wrapper-order-manager>
        <order-manager class="order-manager">
            <notice notice-id="order-global" class="notice order-manager__notice" data-show="hide" data-color="red"></notice>
            <?php 
            if ($pName['count_orders_not_unload'][0]['count'] > 0) :
            ?>
            <?php if($pj_arr['user']['acc_type'] >= 126) : ?>
            <notice class="notice order-manager__notice" data-color="light-purple">
                В данный момент оплаченных заказов не переведенных в работу:  <b><?php echo $pName['count_orders_not_unload'][0]['count']; ?></b>. 
                <a class="text" data-color="light-purple" href="?section=orders&no_unload=1">  Показать</a>
            </notice>
            <?php endif; ?>
            <?php
        endif; 
        $order = $pName['orders'];
        if ($order != 0) :
            foreach ($order as $key => $u_o) :
                
                switch ($u_o['status']) {
                    case 1 :
                        $sort_status = 1;
                        if ($u_o['unload'] == 0) { 
                            if ($u_o['in_work'] != 1) {
                                $order_status = 'Оплачен';    
                                $order_color = 'green'; 
                                $order_date_event = $u_o['date_pay'];
                            } else {
                                $sort_status = 3;
                                $order_status = 'В работе';    
                                $order_color = 'orange'; 
                                $order_date_event = $u_o['in_work_date'];
                            }
                        } else {
                            if ($u_o['receiving'] != 1) {
                                $order_status = 'Выгружен';    
                                $order_color = 'purple'; 
                                if (strlen($u_o['unload_date']) > 2) {
                                    $order_status = 'Выгружен';
                                    $order_date_event = $u_o['unload_date'];
                                } else {
                                    $order_status = 'Ожидает выгрузку';
                                    $order_date_event = '';
                                }
                                $sort_status = 4;
                            } else {
                                $order_status = 'Получен';    
                                $order_color = 'blue'; 
                                $order_date_event = $u_o['receiving_date'];
                                $sort_status = 7;
                            }
                        }
                    break;
                    case 2 : $order_status = 'Не оплачен'; $order_color = 'gray'; $order_date_event = ''; $sort_status = 2; break;
                    case 7 : 
                        if ($u_o['disbursement_date'] == '0') {
                            $order_status = 'Получен'; 
                            $order_color = 'blue'; 
                            $order_date_event = $u_o['receiving_date'];
                            $sort_status = 7;
                        } else {
                            $order_status = 'Выплачен'; 
                            $order_color = 'light-blue'; 
                            $order_date_event = $u_o['disbursement_date'];
                            $sort_status = 8;
                        }
                    break;
                }

                switch ($u_o['client']) {
                    case 0 : $client_color = ''; break;
                    case 1 : $client_color = 'yellow'; break;
                }
                switch ($u_o['ps_status']) {
                    case 0 : 
                        $ps_status = 'удалена'; 
                        $ps_color = 'red'; 
                    break;
                    case 1 : 
                        $ps_status = 'открыта'; 
                        $ps_color = 'green'; 
                    break;
                    case 2 : 
                        $ps_status = 'только просмотр'; 
                        $ps_color = 'purple'; 
                    break;
                }
                if ($u_o['change_sum'] == 1) {
                    $u_o['change_sum-color'] = 'red';
                } else {
                    $u_o['change_sum-color'] = '';
                }

                $show_event_date = 1;

                if ($u_o['closed'] == 1) {
                    $order_status = 'Закрыт'; 
                    $order_color = 'red'; 
                    $order_date_event = $u_o['date_pay'];
                    // $show_event_date = 0;
                }
                if ($u_o['status'] == 2) {
                    // $show_event_date = 0;
                }
               
        ?>

        <?php if  ($u_o['status'] != 0) : ?>
        <wrapper-order-info  order-id="<?php echo $u_o['id']; ?>" sort-status="<?= $sort_status; ?>" order-status="<?php echo $u_o['status']; ?>" client-status="<?php echo $u_o['client']; ?>">
            <div class="order-top-info">
                <?php if ($u_o['client'] == 1) : ?>
                    <div class="order-sticker" data-content="Заказ Заказчика">
                        <i class="far fa-crown"></i>
                    </div>
                <?php endif; ?>
                <?php if ($u_o['manager_notice'] == 1) : ?>
                    <div class="order-sticker" data-content="В заказе есть примечание Сотрудника">
                        <i class="far fa-exclamation-triangle"></i>
                    </div>
                <?php endif; ?>
                <?php if ($u_o['change_sum'] == 1) : ?>
                    <div class="order-sticker" data-content="У заказа была изменена сумма">
                        <i class="far fa-cash-register"></i>
                    </div>
                <?php endif; ?>
                <?php if ($u_o['change_status'] == 1) : ?>
                    <div class="order-sticker" data-content="Статус оплаты для заказа был изменен">
                        <i class="far fa-sync-alt"></i>
                    </div>
                <?php endif; ?>
            </div>
            <order-info class="order-info block text-block" data-bg="<?= $client_color; ?>" data-border="<?= $order_color; ?>" client-status="<?php echo $u_o['client']; ?>" client-id="<?php echo $u_o['uid']; ?>" children="<?php echo $u_o['low_fi_child']; ?>" payer="<?php echo $u_o['low_fio_payer']; ?>" phone="<?php echo $u_o['phone']; ?>" email="<?php echo $u_o['email']; ?>" order-id="<?php echo $u_o['id']; ?>" data-id="<?php echo $u_o['id']; ?>_order-border" c-date="<?php echo $u_o['c_date']; ?>" c-date-pay="<?php echo $u_o['c_date_pay']; ?>">
                <order-data class="order-data">
                    <order-data-item class="order-data__item">
                        <data-name class="data-name big-sub">
                            <span class="data-name__title">№:</span>
                            <span class="text-block__bold  <?php echo $client_color; ?>" el="number"><?php echo $u_o['id']; ?></span>
                        </data-name>
                        <data-name class="data-name sup">
                            <span class="data-name__title">Клиент ID: </span>
                            <span el="client_id"> <?php echo $u_o['uid']; ?></span>
                        </data-name>
                    </order-data-item>
                    <order-data-item class="order-data__item">
                        <data-name class="data-name sub">
                            <span class="data-name__title">Сумма: </span>
                            <span class="text-block__bold <?php echo $u_o['change_sum-color']; ?>"> <?php echo $u_o['sum']; ?> </span> руб.
                        </data-name>
                        <?php if ($u_o['discount'] > 0) : ?>
                        <data-name class="data-name sup">
                            <span class="data-name__title">Скидка: </span>
                            <span class="text-block__bold"><?php echo $u_o['discount']; ?></span>
                        </data-name>
                        <?php endif; ?>
                        <data-name class="data-name sup">
                            <span class="data-name__title">Статус: </span>
                            <span order-id="<?php echo $u_o['id']; ?>" data-id="<?php echo $u_o['id']; ?>_order-status-text" data-color="<?php echo $order_color; ?>" class="text-block__bold" order-id="<?php echo $u_o['id']; ?>"><?php echo $order_status; ?></span>
                        </data-name>
                    </order-data-item>
                    <order-data-item class="order-data__item">
                        <data-name class="data-name sub" style="display: inline-flex;">
                            <?php if ($u_o['closed'] != 1) : ?>
                            <span class="data-name__title"><?= $order_status ?> </span>
                                <?php if ($order_date_event) : ?>
                                <span class="text-block__bold picked"> <span>: <?= $order_date_event; ?></span></span>
                                <?php 
                                endif;
                            else : 
                                if ($u_o['closed_date'] != '0') :
                                    
                            ?> 
                                <span class="data-name__title">Был закрыт </span>
                                <span class="text-block__bold picked"> <span data-id="<?= $u_o['id']; ?>_order-event-date">: <?= $u_o['closed_date']; ?></span></span> 
                            <?php
                                else :
                            ?>  
                                <span class="data-name__title">Был закрыт</span>
                            <?php 
                                endif;
                            endif; 
                            ?>
                        </data-name>
                        <?php if (($u_o['status'] == 1 || $u_o['status'] == 7) && $u_o['in_work'] == 1) : ?>
                        <data-name class="data-name sup">
                            <span class="data-name__title">Оплачен</span>
                            <span class="text-block__bold">: <?= $u_o['date_pay']; ?></span>
                        </data-name>
                        <?php endif; ?>
                        <data-name class="data-name sup">
                            <span class="data-name__title">Создан</span>
                            <span class="text-block__bold">: <?php echo $u_o['date']; ?></span>
                        </data-name>
                    </order-data-item>
                    <?php /* if ($u_o['unload'] == 1) : ?>
                    <order-data-item class="order-data__item">
                        <data-name class="data-name sub">
                            <span class="data-name__title">В работе: </span>
                            <span class="text-block__bold picked"><?= $u_o['unload_date']; ?></span>
                        </data-name>
                    </order-data-item>
                    <?php endif; */ ?>
                </order-data>
                <person-data class="person-data block text-block">
                    <ps-data class="ps-data">
                    <?php 
                        switch ($u_o['type']) {
                            case 'ps'  : 
                                switch ($u_o['ps_type']) {
                                    case 's' :  
                                        $type_ps_text = 'Школьная'; 
                                        $sym = 'Школьная';
                                    break;
                                    case 'k' : 
                                        $type_ps_text = 'Детский сад'; 
                                        $sym = 'Детский сад'; 
                                    break;
                                    case 'base' : 
                                        $type_ps_text = $u_o['type_data']; 
                                        $sym = $u_o['type_data'];
                                    break;
                                }
                                 
                                $url = '/ps?id=' . $u_o['psid']; 
                                $url_view_page='/manager?section=view-order-ps&order_id=' . $u_o['id'];
                            break;
                            case 'alb' : 
                                $type_ps_text = 'Альбом'; 
                                $sym = 'Альбом'; 
                                $url = '/ps?id=' . $u_o['psid']; $url_view_page='/manager?section=view-order-alb&order_id=' . $u_o['id'];
                            break;
                        }

                    ?>
                        <ps-data-item class="ps-data__item">
                            <span class="ps-data__title text-block__bold">
                                Фотосессия ID:
                            </span>
                            <span class="ps-data__descr">
                                <?= '<a class="link" href="/manager?section=orders&search_type=psid&search_value=' . $u_o['psid'] . '">' . $u_o['psid'] . '</a>'; ?> 
                            </span>
                        </ps-data-item>
                        <ps-data-item class="ps-data__item <?php echo $c_hid; ?>">
                            <span class="ps-data__title text-block__bold">
                                Cтатус:
                            </span>
                            <span class="ps-data__descr <?php echo $ps_color; ?>">
                                <?php echo $ps_status; ?>
                            </span>
                        </ps-data-item>
                        <ps-data-item class="ps-data__item">
                            <span class="ps-data__title text-block__bold">
                                <?= $type_ps_text; ?>:
                            </span>
                            <!-- <a class="person-data__link" href="#" target="_blank"> -->
                                <span><?php echo $u_o['value'] . ', ' . $u_o['s_group']; ?></span>
                            <!-- </a> -->
                        </ps-data-item>
                    </ps-data>

                    <?php if ($u_o['fio_payer'] != '0' || $u_o['fi_child'] != '0' || $u_o['phone'] != '0') : ?>
                    <payer-data class="payer-data">
                        <?php if ($u_o['fio_payer'] != '0') : ?>
                        <payer-data-item class="ps-data__item">
                            <span class="ps-data__title text-block__bold">
                                Плательщик:
                            </span>
                            <span class="ps-data__descr">
                                <?= $u_o['fio_payer']; ?>
                            </span>
                        </payer-data-item>
                        <? endif; ?>
                        <?php if ($u_o['fi_child'] != '0') : ?>
                        <payer-data-item class="ps-data__item">
                            <span class="ps-data__title text-block__bold">
                                Ребёнок:
                            </span>
                            <span class="ps-data__descr">
                                <?php echo $u_o['fi_child']; ?>
                            </span>
                        </payer-data-item>
                        <? endif; ?>
                        <?php if ($u_o['phone'] != '0') : ?>
                        <payer-data-item class="ps-data__item <?php echo $c_hid; ?>">
                            <span class="ps-data__title text-block__bold">
                                Телефон:
                            </span>
                            <span class="ps-data__descr">
                                <?php echo $u_o['phone']; ?>
                            </span>
                        </payer-data-item>
                        <? endif; ?>
                    </payer-data>
                    <? endif; ?>

                    <?php if ($u_o['address'] != '0' || $u_o['email_payer'] != '0') : ?>
                    <payer-data class="payer-data">
                        <?php if ($u_o['email_payer'] != '0') : ?>
                        <payer-data-item class="ps-data__item <?php echo $c_hid; ?>">
                            <span class="ps-data__title text-block__bold">
                                Email:
                            </span>
                            <span class="ps-data__descr">
                                <?= $u_o['email_payer']; ?>
                            </span>
                        </payer-data-item>
                        <? endif; ?>
                        <?php if ($u_o['address'] != '0') : ?>
                        <payer-data-item class="ps-data__item <?php echo $c_hid; ?>">
                            <span class="ps-data__title text-block__bold">
                                Адрес:
                            </span>
                            <span class="ps-data__descr">
                                <?= $u_o['address']; ?>
                            </span>
                        </payer-data-item>
                        <? endif; ?>
                    </payer-data>
                    <? endif; ?>

                </person-data>
                <div class="payer-data__btn">
                    <a href="<?= $url_view_page; ?>" class="button button--size_l" data-color="purple">Просмотр</a>
                    <?php if ($u_o['receiving_email'] == 0 && $u_o['disbursement_date'] == 0 && $u_o['closed'] == 0) : ?>
                    <div data-id="<?php echo $u_o['id']; ?>_order-buttons" class="payer-data__block-btn">
                        <?php 
                        $show_close = 0;
                        $show_nopaid = 0;
                        $show_paid = 0;
                        $show_in_work = 0;
                        $show_no_in_work = 0;
                        $show_unload = 0;
                        $show_nounload = 0;
                        $show_receiving = 0;
                        $show_noreceiving = 0;
                        $show_send_notice = 0;

                        if ($u_o['status'] == 2) {
                            $show_close = 1;
                            $show_paid = 1;
                        }
                        if ($u_o['status'] == 1) {
                            if ($u_o['in_work'] != 1 && $u_o['unload'] != 1) {
                                $show_nopaid = 1;
                                $show_in_work = 1;
                            }
                            if ($u_o['in_work'] == 1 && $u_o['unload'] != 1) {
                                $show_no_in_work = 1;
                                $show_unload = 1;
                            }
                            if ($u_o['in_work'] == 1 && $u_o['unload'] == 1) {
                                if ($u_o['receiving'] != 1) {
                                    $show_receiving = 1;
                                    $show_nounload = 1;
                                } else {
                                    $show_noreceiving = 1;
                                    if ($u_o['receiving_email'] == 0) {
                                        $show_send_notice = 1;
                                    } else {
                                        $show_send_notice = 0;
                                    }
                                }
                            }
                        }
                        ?>

                        <div data-show="<?= $show_send_notice; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="10" class="button button--size_l" data-color="light-blue" order-id="<?php echo $u_o['id']; ?>" onclick="Manager_Orders.send_notice(this)">
                            <span class="icon-question icon-left" data-content="Автоматически отправит уведомление пользователю на email.<br><br>Важно! После этого с Заказам нельзя будет ничего сделать.<br><br>Данное действие необратимо."></span>
                            Уведомить
                        </div>

                        <div data-show="<?= $show_noreceiving; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="9" class="button button--size_l" data-color="red" order-id="<?php echo $u_o['id']; ?>" onclick="Manager_Orders.no_receiving(this)">Не получен</div>

                        <div data-show="<?= $show_receiving; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="8" class="button button--size_l" data-color="blue" order-id="<?php echo $u_o['id']; ?>" onclick="Manager_Orders.receiving(this)">Получен</div>

                        <div data-show="<?= $show_nounload; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="7" class="button button--size_l" data-color="red" order-id="<?php echo $u_o['id']; ?>" onclick="Manager_Orders.no_unload(this)">Не выгружен</div>

                        <div data-show="<?= $show_unload; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="6" class="button button--size_l" data-color="light-purple" order-id="<?php echo $u_o['id']; ?>" psid="<?= $u_o['psid']; ?>" data-type-ps="<?= $u_o['ps_type']; ?>" data-target="unloading-orders" data-uploading-type="uploading-order-<?= $u_o['type']; ?>" onclick="Manager.openModalUnloadingOrders(this);">
                            <span class="icon-question icon-left" data-content="Данное действие запустит Автопроцесс: Выгрузка, для данного заказа."></span>
                            Выгрузка
                        </div>

                        <div data-show="<?= $show_unload; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="6" class="button button--size_l" data-color="gray" order-id="<?php echo $u_o['id']; ?>" onclick="Manager_Orders.already_unload(this)">
                            Уже выгружен
                        </div>

                        <div data-show="<?= $show_no_in_work; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="5" class="button button--size_l" data-color="red" order-id="<?php echo $u_o['id']; ?>" onclick="Manager_Orders.no_in_work(this)">Не в работе</div>

                        <div data-show="<?= $show_in_work; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="4" class="button button--size_l" data-color="orange" order-id="<?php echo $u_o['id']; ?>" onclick="Manager_Orders.in_work(this)">В работе</div>

                        <div data-show="<?= $show_paid; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="3" order-id="<?php echo $u_o['id']; ?>" data-id="<?php echo $u_o['id']; ?>_button-paid" class="button button--size_l" data-color="green" onclick="Manager_Orders.paid(this)">
                            Оплачен
                        </div>

                        <?php if ($pj_arr['owner']['data']['owner_acq'] == '0') : ?>

                            <?php if ($u_o['type_pay'] == 'owner' || $u_o['type_pay'] == '0' || $u_o['type_pay'] == 'auto') : ?>
                            <div data-show="<?= $show_nopaid; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="2" class="button button--size_l" data-id="<?php echo $u_o['id']; ?>_button-cancel" data-color="gray" order-id="<?php echo $u_o['id']; ?>" onclick="Manager_Orders.cancel(this)">Не оплачен</div> 
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if (($u_o['type_pay'] == 'owner' || $u_o['type_pay'] == '0' || $u_o['type_pay'] == 'auto') && $u_o['status'] == '2') : ?>
                        <div data-show="<?= $show_close; ?>" data-group-order-id="<?= $u_o['id']; ?>" data-button-number="1" order-id="<?php echo $u_o['id']; ?>" data-id="<?php echo $u_o['id']; ?>_button-close" class="button button--size_l" data-color="red" onclick="Manager_Orders.close(this)">
                            <span class="icon-question icon-left" data-content="Закрытие заказа, не позволит пользователю просматривать и оплачивать заказ.<br><br>Важно! Если пользователь уже находится на странице оплаты и Вы закроете Заказ, при успешной оплате Заказ получит статус: Оплачен.<br><br>Данное действие необратимо."></span>
                            Закрыть
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </order-info>
        </wrapper-order-info>
        <?php endif; ?>
        <?php 
        endforeach; 
        ?>
        <?php else : ?>
            <notice class="notice">Заказы не найдены</notice>
        <?php endif; ?>
        </order-manager>
        <?php if ($pName['school']['flag'] == 3) : ?>
        <!-- Для десктопа выводим данные по школе --> 
        <!-- <wrapper-order-total-data-desktop>
            <div class="fixed-block">
                <div class="block">
                    <div class="order-total-data text-14">
                        <?php
                        switch ($pName['orders'][0]['ps_type']) {
                            case 's' : $str = 'Школе №'; break;
                            case 'k' : $str = 'Детскому саду №'; break;
                        }
                        ?>
                        <div>Информация по: <b><?php echo  $str . '&nbsp;' . $pName['orders'][0]['value']; ?></b></div>
                        <div>Всего заказов: <b><?php echo $pName['school']['orders']; ?></b></div>
                        <div>Оплачено заказов: <b><?php echo $pName['school']['paid']['many']; ?></b></div>
                        <div>Оплачено заказов на сумму: <b><?php echo $pName['school']['paid']['sum']; ?>&nbsp;руб.</b></div>
                        <div class="order-total-data__sizes" data-type="desktop"> 
                            <?php 
                            $n = 0;
                            foreach ($pName['school_photos'] as $key => $value) : 
                                echo '<p class="sizes"><b class="text-block__bold">' . $key . '</b> = ' . $value . ';</p>';                               
                            endforeach; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </wrapper-order-total-data-desktop> -->
        <?php endif; ?>
    </wrapper-order-manager>
<?php
// Подключаем модальное окно выгрузки
file_connection($pj_arr['projects.pages'] . '/manager/_section/_components/unloading_orders.comp');
?>
</main>
<!-- Модальное окно для подтверждения удаления заказа --> 
<modal-wrapper data-show="0" onclick="Manager_Orders.close_modal(this)">
    <modal-owerlay class="modal-overlay">
        <div class="modal" id="modal-message">
            <div class="modal__content block center">
                <div class="modal-header"><span class="modal-header__close" onclick="Manager_Orders.close_modal(this)"><i class="far fa-times"></i></span></div>
                <div class="modal-body">
                    <p class="modal-body__title" data-id="modal-orders-title"> 
                    </p>
                    <p class="modal-body__description" data-id="modal-orders-description"> 
                    </p>
                </div>
                <div class="modal__btn">
                    <button id="confirmation_delete" data-id="modal-orders-button" class="button button--size_l" data-color="green"></button>
                    <button onclick="Manager_Orders.close_modal(this)" class="button button--size_l" data-color="gray">Отменить</button>
                </div>
            </div>
        </div>
    </modal-owerlay>
</modal-wrapper>
