<form id="quizForm">
    <!-- ВОПРОС 1 -->
    <div class="quiz-question active" data-question="1">
        <p><strong>1. Сколько Вам лет?</strong></p>
        <input type="radio" id="age1" name="age" value="1" required>
        <label for="age1">18-22</label><br>

        <input type="radio" id="age2" name="age" value="2">
        <label for="age2">23-27</label><br>

        <input type="radio" id="age3" name="age" value="3">
        <label for="age3">28-35</label><br>

        <input type="radio" id="age4" name="age" value="4">
        <label for="age4">36-45</label><br>

        <input type="radio" id="age5" name="age" value="5">
        <label for="age5">46-60</label><br>

        <input type="radio" id="age6" name="age" value="6">
        <label for="age6">Более 60</label><br>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">

            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 2 -->
    <div class="quiz-question" data-question="2">
        <p><strong>2. Ваш пол?</strong></p>
        <input type="radio" id="genderMale" name="gender" value="male" required>
        <label for="genderMale">Мужчина</label><br>

        <input type="radio" id="genderFemale" name="gender" value="female">
        <label for="genderFemale">Женщина</label><br>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 3 -->
    <div class="quiz-question" data-question="3">
        <p><strong>3. Семейное положение?</strong></p>
        <input type="radio" id="maritalMarried" name="maritalStatus" value="married" required>
        <label for="maritalMarried">Женат/Замужем</label><br>

        <input type="radio" id="maritalSingle" name="maritalStatus" value="single">
        <label for="maritalSingle">Холост/Не замужем</label><br>

        <input type="radio" id="maritalCivilUnion" name="maritalStatus" value="civilUnion">
        <label for="maritalCivilUnion">Гражданский брак</label><br>

        <input type="radio" id="maritalDivorced" name="maritalStatus" value="divorced">
        <label for="maritalDivorced">В разводе</label><br>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 4 -->
    <div class="quiz-question" data-question="4">
        <p><strong>4. У вас есть гражданство РФ?</strong></p>
        <input type="radio" id="citizenshipYes" name="citizenship" value="yes" required>
        <label for="citizenshipYes">Да</label><br>

        <input type="radio" id="citizenshipNo" name="citizenship" value="no">
        <label for="citizenshipNo">Нет</label><br>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 5 -->
    <div class="quiz-question" data-question="5">
        <p><strong>5. Где вы проживаете?</strong></p>
        <input type="radio" id="residenceOwn" name="residence" value="own" required>
        <label for="residenceOwn">Собственное жилье</label><br>

        <input type="radio" id="residenceRental" name="residence" value="rental">
        <label for="residenceRental">Съемное жилье</label><br>

        <input type="radio" id="residenceDormitory" name="residence" value="dormitory">
        <label for="residenceDormitory">Общежитие</label><br>

        <input type="radio" id="residenceRelatives" name="residence" value="relatives">
        <label for="residenceRelatives">Жилье родственников</label><br>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 6: Доход + доп. доход -->
    <div class="quiz-question" data-question="6">
        <p><strong>6. Ваш доход в месяц?</strong></p>
        <input type="radio" id="income1" name="income" value="1" required>
        <label for="income1">Менее 10 000</label><br>

        <input type="radio" id="income2" name="income" value="2">
        <label for="income2">10-20 000</label><br>

        <input type="radio" id="income3" name="income" value="3">
        <label for="income3">20-30 000</label><br>

        <input type="radio" id="income4" name="income" value="4">
        <label for="income4">30-40 000</label><br>

        <input type="radio" id="income5" name="income" value="5">
        <label for="income5">40-60 000</label><br>

        <input type="radio" id="income6" name="income" value="6">
        <label for="income6">Более 60 000</label><br>

        <hr />

        <p><strong>Есть ли у Вас дополнительный доход?</strong></p>
        <input type="radio" id="additionalIncomeYes" name="additionalIncome" value="yes" required>
        <label for="additionalIncomeYes">Да</label><br>

        <input type="radio" id="additionalIncomeNo" name="additionalIncome" value="no">
        <label for="additionalIncomeNo">Нет</label><br>

        <!-- Блок, который показывается, если выбран "Доп. доход = Да" -->
        <div class="conditional-block" data-condition="additionalIncomeYes" style="display:none; margin-top:10px;">
            <p><strong>В каком размере дополнительный доход?</strong></p>

            <input type="radio" id="additionalIncomeSize1" name="additionalIncomeSize" value="1">
            <label for="additionalIncomeSize1">Менее 10 000</label><br>

            <input type="radio" id="additionalIncomeSize2" name="additionalIncomeSize" value="2">
            <label for="additionalIncomeSize2">10-20 000</label><br>

            <input type="radio" id="additionalIncomeSize3" name="additionalIncomeSize" value="3">
            <label for="additionalIncomeSize3">20-30 000</label><br>

            <input type="radio" id="additionalIncomeSize4" name="additionalIncomeSize" value="4">
            <label for="additionalIncomeSize4">30-40 000</label><br>

            <input type="radio" id="additionalIncomeSize5" name="additionalIncomeSize" value="5">
            <label for="additionalIncomeSize5">40-60 000</label><br>

            <input type="radio" id="additionalIncomeSize6" name="additionalIncomeSize" value="6">
            <label for="additionalIncomeSize6">Более 60 000</label><br>
        </div>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 7 -->
    <div class="quiz-question" data-question="7">
        <p><strong>7. Стаж работы на последнем месте?</strong></p>
        <input type="radio" id="workExp1" name="workExperience" value="1" required>
        <label for="workExp1">Менее полугода</label><br>

        <input type="radio" id="workExp2" name="workExperience" value="2">
        <label for="workExp2">До 1 года</label><br>

        <input type="radio" id="workExp3" name="workExperience" value="3">
        <label for="workExp3">1-3 года</label><br>

        <input type="radio" id="workExp4" name="workExperience" value="4">
        <label for="workExp4">3-5 лет</label><br>

        <input type="radio" id="workExp5" name="workExperience" value="5">
        <label for="workExp5">5-7 лет</label><br>

        <input type="radio" id="workExp6" name="workExperience" value="6">
        <label for="workExp6">Более 7 лет</label><br>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 8 -->
    <div class="quiz-question" data-question="8">
        <p><strong>8. Какая у вас должность?</strong></p>
        <input type="radio" id="positionManager" name="position" value="manager" required>
        <label for="positionManager">Руководитель</label><br>

        <input type="radio" id="positionEmployee" name="position" value="employee">
        <label for="positionEmployee">Работник</label><br>

        <input type="radio" id="positionEntrepreneur" name="position" value="entrepreneur">
        <label for="positionEntrepreneur">Предприниматель</label><br>

        <input type="radio" id="positionPensioner" name="position" value="pensioner">
        <label for="positionPensioner">Пенсионер</label><br>

        <input type="radio" id="positionStudent" name="position" value="student">
        <label for="positionStudent">Студент</label><br>

        <input type="radio" id="positionUnemployed" name="position" value="unemployed">
        <label for="positionUnemployed">Не работаю</label><br>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 9 -->
    <div class="quiz-question" data-question="9">
        <p><strong>9. Есть ли у вас иждивенцы (дети, инвалиды)?</strong></p>
        <input type="radio" id="dependents0" name="dependents" value="0" required>
        <label for="dependents0">Нет</label><br>

        <input type="radio" id="dependents1" name="dependents" value="1">
        <label for="dependents1">1</label><br>

        <input type="radio" id="dependents2" name="dependents" value="2">
        <label for="dependents2">2</label><br>

        <input type="radio" id="dependents3" name="dependents" value="3">
        <label for="dependents3">3 и более</label><br>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 10: Кредитовались ли вы ранее? -->
    <div class="quiz-question" data-question="10">
        <p><strong>10. Кредитовались ли вы ранее?</strong></p>
        <input type="radio" id="previousCreditYes" name="previousCredit" value="yes" required>
        <label for="previousCreditYes">Да</label><br>

        <input type="radio" id="previousCreditNo" name="previousCredit" value="no">
        <label for="previousCreditNo">Нет</label><br>

        <!-- Появляется, если выбрано "Да" -->
        <div class="conditional-block" data-condition="previousCreditYes" style="display:none; margin-top:10px;">
            <p><strong>Есть ли открытые кредиты?</strong></p>
            <input type="radio" id="openCreditsYes" name="openCredits" value="yes">
            <label for="openCreditsYes">Да</label><br>

            <input type="radio" id="openCreditsNo" name="openCredits" value="no">
            <label for="openCreditsNo">Нет</label><br>

            <!-- Появляется, если выбрано "Есть открытые кредиты?" = Да -->
            <div class="conditional-block" data-condition="openCreditsYes" style="display:none; margin-top:10px;">
                <p><strong>Сколько платите в месяц по кредитам?</strong></p>
                <input type="radio" id="monthlyPayment1" name="monthlyPayment" value="1">
                <label for="monthlyPayment1">Менее 10 000</label><br>

                <input type="radio" id="monthlyPayment2" name="monthlyPayment" value="2">
                <label for="monthlyPayment2">10-20 000</label><br>

                <input type="radio" id="monthlyPayment3" name="monthlyPayment" value="3">
                <label for="monthlyPayment3">20-30 000</label><br>

                <input type="radio" id="monthlyPayment4" name="monthlyPayment" value="4">
                <label for="monthlyPayment4">30-40 000</label><br>

                <input type="radio" id="monthlyPayment5" name="monthlyPayment" value="5">
                <label for="monthlyPayment5">40-60 000</label><br>

                <input type="radio" id="monthlyPayment6" name="monthlyPayment" value="6">
                <label for="monthlyPayment6">Более 60 000</label><br>
            </div>
        </div>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 11: Кредитная история -->
    <div class="quiz-question" data-question="11">
        <p><strong>11. Какая у вас кредитная история?</strong></p>
        <input type="radio" id="creditHistoryPositive" name="creditHistory" value="positive" required>
        <label for="creditHistoryPositive">Положительная</label><br>

        <input type="radio" id="creditHistoryNegative" name="creditHistory" value="negative">
        <label for="creditHistoryNegative">Негативная</label><br>

        <input type="radio" id="creditHistoryZero" name="creditHistory" value="zero">
        <label for="creditHistoryZero">Нулевая</label><br>

        <input type="radio" id="creditHistoryDelayed" name="creditHistory" value="delayed">
        <label for="creditHistoryDelayed">Были просрочки</label><br>

        <!-- Появляется, если "Были просрочки" -->
        <div class="conditional-block" data-condition="creditHistoryDelayed" style="display:none; margin-top:10px;">
            <p><strong>На сколько дней просрочили?</strong></p>
            <input type="radio" id="overdueDays1" name="overdueDays" value="1">
            <label for="overdueDays1">До 10 дней</label><br>

            <input type="radio" id="overdueDays2" name="overdueDays" value="2">
            <label for="overdueDays2">До 30 дней</label><br>

            <input type="radio" id="overdueDays3" name="overdueDays" value="3">
            <label for="overdueDays3">Более 30 дней</label><br>

            <input type="radio" id="overdueDays4" name="overdueDays" value="4">
            <label for="overdueDays4">Не помню</label><br>
        </div>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 12 -->
    <div class="quiz-question" data-question="12">
        <p><strong>12. Какое у вас образование?</strong></p>
        <input type="radio" id="educationHigher" name="education" value="higher" required>
        <label for="educationHigher">Высшее</label><br>

        <input type="radio" id="educationIncompleteHigher" name="education" value="incompleteHigher">
        <label for="educationIncompleteHigher">Неоконченное высшее</label><br>

        <input type="radio" id="educationSecondarySpecial" name="education" value="secondarySpecial">
        <label for="educationSecondarySpecial">Среднее специальное</label><br>

        <input type="radio" id="educationGeneralSecondary" name="education" value="generalSecondary">
        <label for="educationGeneralSecondary">Среднее общее</label><br>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Продолжить" -->
            <button type="button" class="next-btn">Продолжить</button>
        </div>
    </div>

    <!-- ВОПРОС 13: Автомобиль -->
    <div class="quiz-question" data-question="13">
        <p><strong>13. У вас есть автомобиль?</strong></p>
        <input type="radio" id="carYes" name="car" value="yes" required>
        <label for="carYes">Да</label><br>

        <input type="radio" id="carNo" name="car" value="no">
        <label for="carNo">Нет</label><br>

        <!-- Появляется, если "Да" -->
        <div class="conditional-block" data-condition="carYes" style="display:none; margin-top:10px;">
            <p><strong>Какой именно?</strong></p>
            <input type="radio" id="carTypeNewForeign" name="carType" value="newForeign">
            <label for="carTypeNewForeign">Новая иномарка</label><br>

            <input type="radio" id="carTypeOldForeign" name="carType" value="oldForeign">
            <label for="carTypeOldForeign">Старая иномарка</label><br>

            <input type="radio" id="carTypeNewDomestic" name="carType" value="newDomestic">
            <label for="carTypeNewDomestic">Новый отечественный</label><br>

            <input type="radio" id="carTypeOldDomestic" name="carType" value="oldDomestic">
            <label for="carTypeOldDomestic">Старый отечественный</label><br>
        </div>

        <!-- Контейнер для кнопок -->
        <div class="button-group" style="margin-top: 20px;">
            <!-- Кнопка "Назад" -->
            <button type="button" class="back-btn" style="margin-right: 10px;">Назад</button>
            <!-- Кнопка "Показать результат" -->
            <button type="button" class="next-btn">Показать результат</button>
        </div>
    </div>


</form>