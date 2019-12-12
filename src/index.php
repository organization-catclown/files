<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./scss/all.css">
  <title>教室予約</title>
</head>

<body>
  <?php require './model/RMSController.php'; ?>
  <header id="header">
    <h1 class="c-lbel u-fr">Room Management System</h1>
    <p>学校法人 〇〇〇学園</p>
  </header>
  <main>
    <?php
    $rmsc = new RMSController();
    $rmsc->fetchSelectDatas();
    ?>
    <!-- トップ画面 -->
    <nav>
      <button onclick="showEnter()">enter</button>
      <button onclick="showExit()">exit</button>
      <button onclick="showTeacher()">teacher</button>
    </nav>
    <div class="l-background--top u-hidden" id="js-enterBack"></div>
    <!-- 入室画面 -->
    <?php $rmsc->createroomReservationDataClass(); ?>
    <form method="POST" action="./GET.php" class="l-modal u-absolute__center u-hidden" id="js-enter">
      <div class="l-directionColumn u-hFill ">
        <div class="l-modal__closeBtn" id="js-enterClose">×</div>
        <div class="l-modal__top u-hFill u-textCenter u-relative">
          <ol class="l-justifyCenter l-aiCenter u-vFill">
            <li class="p-progress p-progress--current">氏名入力</li>
            <li class="p-progress u-twoLines">学年・学科<br>選択</li>
            <li class="p-progress">教室選択</li>
            <li class="p-progress u-twoLines">退室予定時間<br>選択</li>
          </ol>
        </div>
        <div class="l-modal__top  u-hFill u-textCenter u-relative u-none">
          <div class="c-label">先生を呼んできてください</div>
        </div>
        <div class="l-modal__body l-flex u-fill" id="js-modalBody">
          <!-- 氏名入力（半角カナ） -->
          <section class="l-modal__page">
            <div class="c-label">氏名を入力してください</div>
            <div class="c-textBox c-textBox--firstName u-mt50" id="js-firstName">
              <input tabindex="-1" name="r_firstName" type="text" class="c-textBox" id="first_name" readonly="readonly" onclick="setTargetC('first_name')">
              <label class="first-name">ｾｲ</label>
              <div class="border-v">
                <div class="border-h"></div>
              </div>
            </div>
            <div class="c-textBox c-textBox--lastName u-mt50" id="js-lastName">
              <input tabindex="-1" name="r_lastName" type="text" class="c-textBox" id="last_name" readonly="readonly" onclick="setTargetC('last_name')">
              <label class="first-name">ﾒｲ</label>
              <div class="border-v">
                <div class="border-h"></div>
              </div>
            </div>
          </section>
          <!-- 学年・学科選択 -->
          <section class="l-modal__page">
            <div class="c-label">学年と学科を選択してください</div>
            <div class="l-flex u-mt50">
              <div class="c-label u-lh5">学年：</div>
              <select tabindex="-1" name="year" id="" class="c-comboBox c-comboBox--year u-fz3 u-lh5">
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
                <option value="">4</option>
              </select>
            </div>
            <div class="l-flex u-mt50">
              <div class="c-label u-lh5">学科：</div>
              <select tabindex="-1" name="class" id="" class="c-comboBox c-comboBox--course u-fz3 u-lh5">
                <?php $rmsc->setCmbClassName(); ?>
              </select>
            </div>
          </section>
          <!-- 使用教室選択 -->
          <section class="l-modal__page">
            <div class="c-label">使用する教室を選択してください</div>
            <div class="l-flex u-mt50">
              <div class="l-flex">
                <div class="c-label u-lh5">教室：</div>
                <select tabindex="-1" name="roomName" id="" class="c-comboBox c-comboBox--floorMap u-fz3 u-lh5">
                  <?php $rmsc->setCmbRoomName(); ?>
                </select>
              </div>
              <div class="l-flex">
                <div class="c-label u-lh5">使用理由：</div>
                <select tabindex="-1" name="reason" id="" class="c-comboBox u-fz3 u-lh5">
                  <?php $rmsc->setCmbReasonName(); ?>
                </select>
              </div>
            </div>
            <div class="c-button c-button--floorMap u-mt50 u-fz3 u-lh5 u-textCenter" id="js-floorMapOpen">フロアマップ</div>
          </section>
          <!-- 退室予定時間選択 -->
          <section class="l-modal__page">
            <div class="c-label">退室予定時間を選択してください</div>
            <div class="l-flex  u-mt50">
              <select tabindex="-1" name="leaveTimeHour" id="" class="c-comboBox c-comboBox-floorMap u-fz3 u-lh5">
              </select>
              <div class="c-label u-lh5">：</div>
              <select tabindex="-1" name="" id="leaveTimeSec" class="c-comboBox c-comboBox-floorMap u-fz3 u-lh5">
              </select>
            </div>
          </section>
          <div class="l-modal__page">
            <div class="c-label">教員番号を入力してください</div>
            <div class="c-textBox c-textBox--teacherCode u-mt50">
              <input tabindex="-1" name="teacherCode" type="text" class="c-textBox" readonly="readonly" onclick="setTargetN('teacher_code')">
              <div class="border-v">
                <div class="border-h"></div>
              </div>
            </div>
            <input type="submit" value="" id="submit">
          </div>
        </div>
      </div>
      <span class="p-modal__btn p-modal__btn--back u-hidden" id="js-backBtn">戻る</span>
      <span class="p-modal__btn p-modal__btn--next" id="js-nextBtn">次へ</span>
      <div class="p-modal__btn p-modal__btn--decision u-hidden" id="js-decisionBtn">決定</div>
    </form>
    <?php require './model/RESERVATION_POST.php' ?>
    <!-- フロアマップ -->
    <div class="l-background--floorMap u-hidden" id="js-floorMapBack"></div>
    <div class="l-floorMap u-hidden" id="js-floorMap">
      <div class="l-floorMap__closeBtn" id="js-floorMapClose">×</div>
      <div class="l-floorMap__main u-absolute__center">
        <img src="./assets/f1.jpg" alt="" class="p-floorMapImg">
        <img src="./assets/f2.jpg" alt="" class="p-floorMapImg u-none">
        <img src="./assets/f3.jpg" alt="" class="p-floorMapImg u-none">
        <img src="./assets/f4.jpg" alt="" class="p-floorMapImg u-none">
        <img src="./assets/f5.jpg" alt="" class="p-floorMapImg u-none">
      </div>
      <div class="l-floorMap__side u-absolute u-absolute__centerRight">
        <div class="p-floorMapBtn">1F</div>
        <div class="p-floorMapBtn p-floorMapBtn--current">2F</div>
        <div class="p-floorMapBtn">3F</div>
        <div class="p-floorMapBtn">4F</div>
        <div class="p-floorMapBtn">5F</div>
      </div>
    </div>
    <!-- 入室確認モーダル -->
    <div class="l-background--top u-hidden" id="js-enterMiniBack"></div>
    <div class="l-miniModal  u-absolute__center u-hidden" id="js-enterMini">
      <div class="l-directionClumn u-vFill">
        <div class="l-modal__closeBtn" id="js-enterMiniClose">×</div>
        <div class="l-miniModal__top"></div>
        <div class="l-miniModal__body">
          <label for="submit" name="insert">決定</label>
        </div>
      </div>
    </div>

    <div class="l-background--top u-hidden" id="js-exitBack"></div>
    <!-- 退出画面 -->
    <?php $rmsc->createLeaveDataClass(); ?>
    <form class="l-modal u-absolute__center u-hidden" id="js-exit">
      <div class="l-directionColumn u-hFill ">
        <div class="l-modal__closeBtn" id="js-exitClose">×</div>
        <div class="l-modal__top  u-hFill u-textCenter u-relative">
          <div class="c-label">先生を呼んできてください</div>
        </div>
        <div class="l-modal__body l-flex u-fill" id="js-enterBody">
          <div class="l-modal__page">
            <div class="c-label">教員番号を入力してください</div>
            <div class="c-textBox c-textBox--teacherCode u-mt50">
              <input tabindex="-1" type="text" class="c-textBox" readonly="readonly" onclick="setTargetN('teacher_code')">
              <div class="border-v">
                <div class="border-h"></div>
              </div>
            </div>
          </div>
        </div>
        <span class="p-modal__btn p-modal__btn--back u-hidden" id="js-exitBackBtn">戻る</span>
        <span class="p-modal__btn p-modal__btn--next" id="js-exitNextBtn">次へ</span>
        <div class="p-modal__btn p-modal__btn--submit u-hidden">決定</div>
      </div>
    </form>
    <?php require './model/LEAVE_POST.php' ?>
    <div class="l-background--top u-hidden" id="js-teacherBack"></div>
    <!-- 教員用画面 -->
    <form class="l-modal u-absolute__center u-hidden" id="js-teacher">
      <div class="l-directionColumn u-hFill ">
        <div class="l-modal__closeBtn" id="js-teacherClose">×</div>
        <div class="l-modal__top  u-hFill u-textCenter u-relative">
          <div class="c-label">先生を呼んできてください</div>
        </div>
        <div class="l-modal__body l-flex u-fill" id="js-teacherBody">
          <div class="l-modal__page">
            <div class="c-label">教員番号を入力してください</div>
            <div class="c-textBox c-textBox--teacherCode u-mt50">
              <input tabindex="-1" type="text" class="c-textBox" readonly="readonly" onclick="setTargetN('teacher_code')">
              <div class="border-v">
                <div class="border-h"></div>
              </div>
            </div>
          </div>
        </div>
        <span class="p-modal__btn p-modal__btn--back u-hidden" id="js-teacherBackBtn">戻る</span>
        <span class="p-modal__btn p-modal__btn--next" id="js-teacherNextBtn">次へ</span>
        <div class="p-modal__btn p-modal__btn--submit u-hidden">決定</div>
      </div>
    </form>
  </main>
  <div class="l-keybordBack u-hidden" id="js-keybordBack" onclick="hideKeybord()"></div>
  <!-- キーボード -->
  <div class="l-keybord l-directionRowR u-absolute__bottomCenter u-hidden" id="js-keybord">
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="backSpace()">削除</button>
      <button class="l-keybord__btn" onclick="toggleSize()">大/小</button>
      <button class="l-keybord__btn" onclick="toggleDakuon()">゛/ ゜</button>
      <button class="l-keybord__btn l-keybord__btn--twice" onclick="enter()">確定</button>
    </div>
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('ア')">ア</button>
      <button class="l-keybord__btn" onclick="setChar('イ')">イ</button>
      <button class="l-keybord__btn" onclick="setChar('ウ')">ウ</button>
      <button class="l-keybord__btn" onclick="setChar('エ')">エ</button>
      <button class="l-keybord__btn" onclick="setChar('オ')">オ</button>
    </div>
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('カ')">カ</button>
      <button class="l-keybord__btn" onclick="setChar('キ')">キ</button>
      <button class="l-keybord__btn" onclick="setChar('ク')">ク</button>
      <button class="l-keybord__btn" onclick="setChar('ケ')">ケ</button>
      <button class="l-keybord__btn" onclick="setChar('コ')">コ</button>
    </div>
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('サ')">サ</button>
      <button class="l-keybord__btn" onclick="setChar('シ')">シ</button>
      <button class="l-keybord__btn" onclick="setChar('ス')">ス</button>
      <button class="l-keybord__btn" onclick="setChar('セ')">セ</button>
      <button class="l-keybord__btn" onclick="setChar('ソ')">ソ</button>
    </div>
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('タ')">タ</button>
      <button class="l-keybord__btn" onclick="setChar('チ')">チ</button>
      <button class="l-keybord__btn" onclick="setChar('ツ')">ツ</button>
      <button class="l-keybord__btn" onclick="setChar('テ')">テ</button>
      <button class="l-keybord__btn" onclick="setChar('ト')">ト</button>
    </div>
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('ナ')">ナ</button>
      <button class="l-keybord__btn" onclick="setChar('ニ')">ニ</button>
      <button class="l-keybord__btn" onclick="setChar('ヌ')">ヌ</button>
      <button class="l-keybord__btn" onclick="setChar('ネ')">ネ</button>
      <button class="l-keybord__btn" onclick="setChar('ノ')">ノ</button>
    </div>
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('ハ')">ハ</button>
      <button class="l-keybord__btn" onclick="setChar('ヒ')">ヒ</button>
      <button class="l-keybord__btn" onclick="setChar('フ')">フ</button>
      <button class="l-keybord__btn" onclick="setChar('ヘ')">ヘ</button>
      <button class="l-keybord__btn" onclick="setChar('ホ')">ホ</button>
    </div>
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('マ')">マ</button>
      <button class="l-keybord__btn" onclick="setChar('ミ')">ミ</button>
      <button class="l-keybord__btn" onclick="setChar('ム')">ム</button>
      <button class="l-keybord__btn" onclick="setChar('メ')">メ</button>
      <button class="l-keybord__btn" onclick="setChar('モ')">モ</button>
    </div>
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('ヤ')">ヤ</button>
      <button class="l-keybord__btn l-keybord__btn--hidden">&nbsp;</button>
      <button class="l-keybord__btn" onclick="setChar('ユ')">ユ</button>
      <button class="l-keybord__btn l-keybord__btn--hidden">&nbsp;</button>
      <button class="l-keybord__btn" onclick="setChar('ヨ')">ヨ</button>
    </div>
    <div class="l-direcrionColumn u-ml2 u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('ラ')">ラ</button>
      <button class="l-keybord__btn" onclick="setChar('リ')">リ</button>
      <button class="l-keybord__btn" onclick="setChar('ル')">ル</button>
      <button class="l-keybord__btn" onclick="setChar('レ')">レ</button>
      <button class="l-keybord__btn" onclick="setChar('ロ')">ロ</button>
    </div>
    <div class="l-direcrionColumn u-h11th u-vFifth">
      <button class="l-keybord__btn" onclick="setChar('ワ')">ワ</button>
      <button class="l-keybord__btn" onclick="setChar('ヲ')">ヲ</button>
      <button class="l-keybord__btn" onclick="setChar('ノ')">ン</button>
      <button class="l-keybord__btn" onclick="setChar('ー')">ー</button>
      <button class="l-keybord__btn l-keybord__btn--hidden">&nbsp;</button>
    </div>
  </div>

  <!-- テンキー -->
  <div class="l-tenkeybord l-directionColumn">
    <div class="l-flex u-vQuatuor u-hFill">
      <button class="l-tenkeybord__btn">7</button>
      <button class="l-tenkeybord__btn">8</button>
      <button class="l-tenkeybord__btn">9</button>
      <button class="l-tenkeybord__btn">&nbsp;</button>
    </div>
    <div class="l-flex u-vQuatuor u-hFill u-mt3">
      <button class="l-tenkeybord__btn">4</button>
      <button class="l-tenkeybord__btn">5</button>
      <button class="l-tenkeybord__btn">6</button>
      <button class="l-tenkeybord__btn">&nbsp;</button>
    </div>
    <div class="l-flex u-vQuatuor u-hFill u-mt3">
      <button class="l-tenkeybord__btn">1</button>
      <button class="l-tenkeybord__btn">2</button>
      <button class="l-tenkeybord__btn">3</button>
      <button class="l-tenkeybord__btn">&nbsp;</button>
    </div>
    <div class="l-flex u-vQuatuor u-hFill u-mt3">
      <button class="l-tenkeybord__btn">0</button>
      <button class="l-tenkeybord__btn">&nbsp;</button>
      <button class="l-tenkeybord__btn">&nbsp;</button>
      <button class="l-tenkeybord__btn">&nbsp;</button>
    </div>
  </div>
  <script src="./script/script.js"></script>
</body>

</html>