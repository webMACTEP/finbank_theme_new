<?php
$type = $args['type'];

//$filter_price = get_filter_price();

?>

<?php if($type == 'creditcard'):?>

    <!-- calc -->
    <div class="calc_v1">
        <div class="row align-items-center mt-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="calc-v1" id="calc" data-type="creditCalc">
                    <div class="d-flex h2 pl-0 mb-4 ">
                        Кредитный калькулятор
                    </div>

                    <div class="calc__content-buttons d-flex col-7  pl-0">
                        <label class="btn__radio">
                            <input class="calc__input" type="radio" name="caclType" data-field="type" value="1" checked="">
                            <span class="btn__radio-text">Аннуентный</span>
                        </label>
                        <label class="btn__radio">
                            <input class="calc__input" type="radio" name="caclType" data-field="type" value="2">
                            <span class="btn__radio-text">Дифференцированный</span>
                        </label>
                    </div>

                    <div class="calc__content">
                        <div class="row">
                            <div class="col-12 col-lg-5 box_num_1">

                                <div class="range">
                                    <div class="d-flex justify-content-between">
                                        <div class="range__label">Кредитный лимит,<b>₽</b></div>
                                        <input max="40000000" type="text" class="range__value calc__input" value="1000000" min="0" max="10000000" data-field="limit" >
                                    </div>
                                    <input max="40000000" class="range__input calc__input" type="range" min="0" name="range1" value="1000000"  data-field="limit" style="--range-progress: 10%;">
                                </div>
                                <div class=" d-flex justify-content-between">
                                    <div class="input_date_1 calc__field-wrap mt-3 mt-md-4 flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <div class="range__label">Срок / месяц</div>
                                            <input type="text" class="input-inner range__value calc__input" value="10" min="1" max="40" data-field="date">
                                        </div>
                                        <input class="range__input calc__input" name="range2" type="range" min="1" max="40" value="10" data-field="date" style="--range-progress:23.0769%;">
                                    </div>
                                    <div class="input_date_1 calc__field-wrap mt-3 mt-md-4 flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <div class="range__label">Ставка</div>
                                            <input type="text" class="input-inner range__value calc__input" value="10%" min="1%" max="100%" data-field="percent">
                                        </div>
                                        <input class="range__input calc__input" type="range" min="1" max="100" value="10"  maxlength="6" data-field="date" pattern="[0-9]*"  style="--range-progress:23.0769%;">
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-4 box_num_2">

                                <div class="calc__total">
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Сумма кредита</div>
                                        <div class="calc__value">
                                            <span id="calc__sum" class="calc__value-text">1 000 000</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Переплата</div>
                                        <div class="calc__total-value">
                                            <span id="calc__overpay" class="calc__value-text">70 031</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Общая сумма выплат</div>
                                        <div class="calc__total-value">
                                            <span id="calc__total" class="calc__value-text">1 070 031</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Окончание кредита</div>
                                        <div class="calc__total-value">
                                            <span id="calc__dateEnd" class="calc__value-text">05.05.2023</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Платежи в месяц</div>
                                        <div class="calc__total-value">
                                            <span id="calc__payments" class="calc__value-text">107 003</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-3 box_num_3">

                                <div class="box_bar_v1">
                                    <div class="progress-bar-v1">
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>





                                    </div>
                                    <div id="calc__progress" class="progress">
                                        <div class="progress__description">По нашим подсчетам, расчитанный кредит на <span class="progress__percent">75</span>% выгоден</div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="order-7 row filter__main_bottom">
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 order-7 order-md-7 mt-4">
                <div class="btn btn-primary btn-block submit-button">Подобрать</div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 order-7 order-md-7 mt-4">
                <input class="popup_close btn btn-outline-alternative btn-block" value="Закрыть">
            </div>
        </div>
    </div>
    <!-- / calc -->

<?php endif; ?>


<?php if($type == 'debetcard' || $type == 'debatcard'):?>

    <div class="calc" id="calc" data-type="cashbackCalc">
        <div class="calc__header d-flex justify-content-between align-items-center h3 m-0 p-3 px-md-4 py-md-3">
            Выберите кэшбэк и укажите ежемесячные расходы
            <div class="tooltip">
                <div class="tooltip__trigger">
                    <svg width="6" height="12" viewBox="0 0 6 12"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#question" width="6" height="12" x="0" y="0"></use></svg>
                </div>
                <div class="tooltip__drop">Введите все нужные вам параметры в калькулятори и получите точный ежемесячный платеж с процентной визуализацией выгоды</div>
            </div>
        </div>
        <div class="calc__content p-3 p-md-4">
            <div class="row align-items-center">
                <div class="col-12 col-md-3">
                    <div class="calc__field">
                        <div class="calc__field-wrap">
                            <div class="calc__field-label">Вид кэшбэка</div>
                            <select name="" id="cashbackTypeSelect" class="styledSelect calc__input" placeholder="" data-field="type">
                                <option value="20000">На всё</option>
                                <option value="5000">АЗС</option>
                                <option value="15000">Кафе и Рестораны</option>
                                <option value="15000">Красота и здоровье</option>
                                <option value="15000">Одежда и обувь</option>
                                <option value="50000">Путешествия</option>
                                <option value="10000">Развлечения</option>
                                <option value="10000">Такси и каршеринг</option>
                                <option value="10000">У партнеров</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="calc__field">
                        <div class="calc__field-wrap">
                            <div class="calc__field-label">Ежемесячные расходы</div>
                            <input type="text" class="range__value form-control calc__input " value="10000" min="0" max="200000" data-field="limit">
                            <input class="range__input calc__input" name="range1" type="range" min="0" max="200000" value="10000" data-field="limit" style="--range-progress:10%;">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="calc__field">
                        <div class="calc__field-wrap">
                            <div class="calc__field-label">Размер кэшбэка %</div>
                            <input type="text" class="range__value form-control calc__input " value="1" min="0" max="100" data-field="percent">
                            <input class="range__input calc__input" name="range1" type="range" min="0" max="100" value="1" data-field="percent" style="--range-progress:1%;">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="calc__total">
                        <div class="calc__total-field d-flex justify-content-between align-items-center">
                            <div class="calc__total-label">Ежемесячные расходы</div>
                            <div class="calc__value">
                                <span id="calc__sum" class="calc__value-text">10 000</span>
                                <span class="calc__value-char">₽</span>
                            </div>
                        </div>
                        <div class="calc__total-field d-flex justify-content-between align-items-center">
                            <div class="calc__total-label">Суммарный кэшбэк в рублях</div>
                            <div class="calc__total-value">
                                <span id="calc__cashbackSum" class="calc__value-text">70 031</span>
                                <span class="calc__value-char">₽</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>


<?php if($type == 'installmentcard'):?>


    <!-- calc -->
    <div class="calc_v1">
        <div class="row align-items-center mt-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="calc-v1" id="calc" data-type="creditCalc">
                    <div class="d-flex h2 pl-0 mb-4 ">
                        Кредитный калькулятор
                    </div>

                    <div class="calc__content-buttons d-flex col-7  pl-0">
                        <label class="btn__radio">
                            <input class="calc__input" type="radio" name="caclType" data-field="type" value="1" checked="">
                            <span class="btn__radio-text">Аннуентный</span>
                        </label>
                        <label class="btn__radio">
                            <input class="calc__input" type="radio" name="caclType" data-field="type" value="2">
                            <span class="btn__radio-text">Дифференцированный</span>
                        </label>
                    </div>

                    <div class="calc__content">
                        <div class="row">
                            <div class="col-12 col-lg-5 box_num_1">

                                <div class="range">
                                    <div class="d-flex justify-content-between">
                                        <div class="range__label">Кредитный лимит,<b>₽</b></div>
                                        <input max="40000000" type="text" class="range__value calc__input" value="1000000" min="0" max="10000000" data-field="limit" >
                                    </div>
                                    <input max="40000000" class="range__input calc__input" type="range" min="0" name="range1" value="1000000"  data-field="limit" style="--range-progress: 10%;">
                                </div>
                                <div class=" d-flex justify-content-between">
                                    <div class="input_date_1 calc__field-wrap mt-3 mt-md-4 flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <div class="range__label">Срок / месяц</div>
                                            <input type="text" class="input-inner range__value calc__input" value="10" min="1" max="40" data-field="date">
                                        </div>
                                        <input class="range__input calc__input" name="range2" type="range" min="1" max="40" value="10" data-field="date" style="--range-progress:23.0769%;">
                                    </div>
                                    <div class="input_date_1 calc__field-wrap mt-3 mt-md-4 flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <div class="range__label">Ставка</div>
                                            <input type="text" class="input-inner range__value calc__input" value="10%" min="1%" max="100%" data-field="percent">
                                        </div>
                                        <input class="range__input calc__input" type="range" min="1" max="100" value="10"  maxlength="6" data-field="date" pattern="[0-9]*"  style="--range-progress:23.0769%;">
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-4 box_num_2">

                                <div class="calc__total">
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Сумма кредита</div>
                                        <div class="calc__value">
                                            <span id="calc__sum" class="calc__value-text">1 000 000</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Переплата</div>
                                        <div class="calc__total-value">
                                            <span id="calc__overpay" class="calc__value-text">70 031</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Общая сумма выплат</div>
                                        <div class="calc__total-value">
                                            <span id="calc__total" class="calc__value-text">1 070 031</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Окончание кредита</div>
                                        <div class="calc__total-value">
                                            <span id="calc__dateEnd" class="calc__value-text">05.05.2023</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Платежи в месяц</div>
                                        <div class="calc__total-value">
                                            <span id="calc__payments" class="calc__value-text">107 003</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-3 box_num_3">

                                <div class="box_bar_v1">
                                    <div class="progress-bar-v1">
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>





                                    </div>
                                    <div id="calc__progress" class="progress">
                                        <div class="progress__description">По нашим подсчетам, расчитанный кредит на <span class="progress__percent">75</span>% выгоден</div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="order-7 row filter__main_bottom">
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 order-7 order-md-7 mt-4">
                <div class="btn btn-primary btn-block submit-button">Подобрать</div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 order-7 order-md-7 mt-4">
                <input class="popup_close btn btn-outline-alternative btn-block" value="Закрыть">
            </div>
        </div>
    </div>
    <!-- / calc -->




<?php endif; ?>


<?php if($type == 'kredity'):?>

    <!-- calc -->
    <div class="calc_v1">
        <div class="row align-items-center mt-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="calc-v1" id="calc" data-type="creditCalc">
                    <div class="d-flex h2 pl-0 mb-4 ">
                        Кредитный калькулятор
                    </div>

                    <div class="calc__content-buttons d-flex col-7  pl-0">
                        <label class="btn__radio">
                            <input class="calc__input" type="radio" name="caclType" data-field="type" value="1" checked="">
                            <span class="btn__radio-text">Аннуентный</span>
                        </label>
                        <label class="btn__radio">
                            <input class="calc__input" type="radio" name="caclType" data-field="type" value="2">
                            <span class="btn__radio-text">Дифференцированный</span>
                        </label>
                    </div>

                    <div class="calc__content">
                        <div class="row">
                            <div class="col-12 col-lg-5 box_num_1">

                                <div class="range">
                                    <div class="d-flex justify-content-between">
                                        <div class="range__label">Кредитный лимит,<b>₽</b></div>
                                        <input max="40000000" type="text" class="range__value calc__input" value="1000000" min="0" max="10000000" data-field="limit" >
                                    </div>
                                    <input max="40000000" class="range__input calc__input" type="range" min="0" name="range1" value="1000000"  data-field="limit" style="--range-progress: 10%;">
                                </div>
                                <div class=" d-flex justify-content-between">
                                    <div class="input_date_1 calc__field-wrap mt-3 mt-md-4 flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <div class="range__label">Срок / месяц</div>
                                            <input type="text" class="input-inner range__value calc__input" value="10" min="1" max="40" data-field="date">
                                        </div>
                                        <input class="range__input calc__input" name="range2" type="range" min="1" max="40" value="10" data-field="date" style="--range-progress:23.0769%;">
                                    </div>
                                    <div class="input_date_1 calc__field-wrap mt-3 mt-md-4 flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <div class="range__label">Ставка</div>
                                            <input type="text" class="input-inner range__value calc__input" value="10%" min="1%" max="100%" data-field="percent">
                                        </div>
                                        <input class="range__input calc__input" type="range" min="1" max="100" value="10"  maxlength="6" data-field="date" pattern="[0-9]*"  style="--range-progress:23.0769%;">
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-4 box_num_2">

                                <div class="calc__total">
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Сумма кредита</div>
                                        <div class="calc__value">
                                            <span id="calc__sum" class="calc__value-text">1 000 000</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Переплата</div>
                                        <div class="calc__total-value">
                                            <span id="calc__overpay" class="calc__value-text">70 031</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Общая сумма выплат</div>
                                        <div class="calc__total-value">
                                            <span id="calc__total" class="calc__value-text">1 070 031</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Окончание кредита</div>
                                        <div class="calc__total-value">
                                            <span id="calc__dateEnd" class="calc__value-text">05.05.2023</span>
                                        </div>
                                    </div>
                                    <div class="calc__total-field d-flex justify-content-between align-items-center">
                                        <div class="calc__total-label">Платежи в месяц</div>
                                        <div class="calc__total-value">
                                            <span id="calc__payments" class="calc__value-text">107 003</span>
                                            <span class="calc__value-char">₽</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-3 box_num_3">

                                <div class="box_bar_v1">
                                    <div class="progress-bar-v1">
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>
                                        <svg class="progress-bar-v1_item" fill="#14B8AD" width="13" height="64" viewBox="0 0 13 64" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="13" height="64" rx="6.5" />
                                        </svg>





                                    </div>
                                    <div id="calc__progress" class="progress">
                                        <div class="progress__description">По нашим подсчетам, расчитанный кредит на <span class="progress__percent">75</span>% выгоден</div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="order-7 row filter__main_bottom">
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 order-7 order-md-7 mt-4">
                <div class="btn btn-primary btn-block submit-button">Подобрать</div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 order-7 order-md-7 mt-4">
                <input class="popup_close btn btn-outline-alternative btn-block" value="Закрыть">
            </div>
        </div>
    </div>
    <!-- / calc -->

<?php endif; ?>



<?php if($type == 'zaimy'):?>


    <div class="row align-items-center mt-4">
        <div class="col-12 col-md-9 col-lg-8">
            <div class="calc" id="calc" data-type="loanCalc">
                <div class="calc__header d-flex justify-content-between align-items-center h3 m-0 p-3 px-md-4 py-md-3">
                    По сумме кредита
                    <div class="tooltip">
                        <div class="tooltip__trigger">
                            <svg width="6" height="12" viewBox="0 0 6 12"><use xlink:href="<?php bloginfo('template_url'); ?>/img/icons.svg#question" width="6" height="12" x="0" y="0"></use></svg>
                        </div>
                        <div class="tooltip__drop">Введите все нужные вам параметры в калькулятори и получите точный ежемесячный платеж с процентной визуализацией выгоды</div>
                    </div>
                </div>
                <div class="calc__content p-3 p-md-4">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="calc__field">
                                <div class="calc__field-wrap">
                                    <div class="calc__field-label">Сумма займа</div>
                                    <input type="text" class="range__value form-control calc__input " value="10000" min="0" max="10000000" data-field="limit">
                                    <input class="range__input calc__input" name="range1" type="range" min="0" max="10000000" value="1000000" data-field="limit" style="--range-progress:10%;">
                                </div>
                            </div>
                            <div class="calc__field d-flex">
                                <div class="calc__field-wrap mt-3 mt-md-4 flex-grow-1">
                                    <div class="calc__field-label">Срок / дней</div>
                                    <input type="text" class="range__value form-control calc__input" value="14" min="1" max="10950" data-field="date">
                                    <input class="range__input calc__input" name="range2" type="range" min="1" max="10950" value="14" data-field="date" style="--range-progress:23.0769%;">
                                </div>
                                <div class="calc__field-wrap calc__field-min mt-3 mt-md-4 ml-3">
                                    <div class="calc__field-label">Ставка</div>
                                    <input type="text" class="range__value form-control calc__input" value="0.5%" maxlength="6" data-field="percent" pattern="[0-9]*">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="calc__total">
                                <div class="calc__total-field d-flex justify-content-between align-items-center">
                                    <div class="calc__total-label">Сумма кредита</div>
                                    <div class="calc__value">
                                        <span id="calc__sum" class="calc__value-text">10 000</span>
                                        <span class="calc__value-char">₽</span>
                                    </div>
                                </div>
                                <div class="calc__total-field d-flex justify-content-between align-items-center">
                                    <div class="calc__total-label">Переплата</div>
                                    <div class="calc__total-value">
                                        <span id="calc__overpay" class="calc__value-text">70 031</span>
                                        <span class="calc__value-char">₽</span>
                                    </div>
                                </div>
                                <div class="calc__total-field d-flex justify-content-between align-items-center">
                                    <div class="calc__total-label">Общая сумма выплат</div>
                                    <div class="calc__total-value">
                                        <span id="calc__total" class="calc__value-text">1 070 031</span>
                                        <span class="calc__value-char">₽</span>
                                    </div>
                                </div>
                                <div class="calc__total-field d-flex justify-content-between align-items-center">
                                    <div class="calc__total-label">Полная стоимость займа</div>
                                    <div class="calc__total-value">
                                        <span id="calc__psk" class="calc__value-text">182.5</span>
                                        <span class="calc__value-char">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-lg-4">
            <div id="calc__progress" class="progress">
                <div class="progress__circle" style="--graph-warning: 10%; --graph-danger: 5%;">
                    <div class="progress__text">
                        <span class="progress__percent">75</span>%
                    </div>
                </div>
                <div class="progress__description">По нашим подсчетам, расчитанный кредит на <span class="progress__percent">75</span>% выгоден</div>
            </div>
        </div>
        <div class="order-7 row filter__main_bottom">
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 order-7 order-md-7 mt-4">
                <div class="btn btn-primary btn-block submit-button">Подобрать</div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-2 order-7 order-md-7 mt-4">
                <input class="popup_close btn btn-outline-alternative btn-block" value="Закрыть">
            </div>
        </div>
    </div>


<?php endif; ?>





