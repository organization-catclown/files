<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="./scss/all.css" />
  <title>教室予約</title>
</head>

<body>
  <header id="header">
    <h1 class="c-lbel u-fr">Room Management System</h1>
    <p>学校法人 〇〇〇学園</p>
  </header>
  <main>
    <?php
    require './model/RMSController.php';
    $rmsc = new RMSController();
    $rmsc->refreshData();
    ?>
    <!-- トップ画面 -->
    <nav>
      <button onclick="ShowEnter()">enter</button>
      <button onclick="ShowExit()">exit</button>
      <button onclick="ShowTeacher()">teacher</button>
    </nav>
    <div class="l-background--top u-hidden" id="js-modal_back"></div>
    <!-- 入室画面 -->
    <?php $rmsc->createroomReservationDataClass(); ?>
    <form method="GET" action="" class="l-modal u-absolute--center u-top--50" id="js-enter" autocomplete="off">
      <div class="l-directionColumn u-hFill ">
        <div class="l-modal__closeBtn" id="js-enter_close">×</div>
        <div class="l-modal__top u-hFill u-textCenter u-relative">
          <ol class="l-justifyCenter l-aiCenter u-vFill">
            <li class="p-progress p-progress--current js-enterProgress">氏名入力</li>
            <li class="p-progress js-enterProgress u-twoLines">学年・学科<br />選択</li>
            <li class="p-progress js-enterProgress">教室選択</li>
            <li class="p-progress js-enterProgress u-twoLines">退室予定時間<br />選択</li>
          </ol>
        </div>
        <div class="l-modal__top  u-hFill u-textCenter u-relative u-none">
          <div class="c-label">先生を呼んできてください</div>
        </div>
        <div class="l-modal__body l-flex u-fill" id="js-enter_body">
          <!-- 氏名入力（半角カナ） -->
          <section class="l-modal__page">
            <div class="c-label">氏名を入力してください</div>
            <div class="c-textBox c-textBox--firstName u-mt50" id="js-first_name">
              <input tabindex="-1" name="r_firstName" type="text" class="c-textBox" id="rfirst_name" onclick="SetTargetC('rfirst_name')" required="required" oncopy="return false" onpaste="return false" oninput="checkKey(this)" onfocus="blur()">
              <label class="first-name" for="rfirst_name">セイ</label>
              <div class="border-v">
                <div class="border-h"></div>
              </div>
            </div>
            <div class="c-textBox c-textBox--lastName u-mt50" id="js-last_name">
              <input tabindex="-1" name="r_lastName" type="text" class="c-textBox" id="rlast_name" onclick="SetTargetC('rlast_name')" required="required" oncopy="return false" onpaste="return false" oninput="checkKey(this)" onfocus="blur()" />
              <label class="first-name" for="rlast_name">メイ</label>
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
              <select tabindex="-1" name="r_schoolYear" id="class_year" class="c-comboBox c-comboBox--year u-fz3 u-lh5">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>
            <div class="l-flex u-mt50">
              <div class="c-label u-lh5">学科：</div>
              <select tabindex="-1" name="r_className" id="class_name" class="c-comboBox c-comboBox--course u-fz3 u-lh5">
                <?php $rmsc->setCmbClassName(); ?>
              </select>
            </div>
          </section>
          <!-- 使用教室選択 -->
          <section class="l-modal__page">
            <div class="c-label">使用する教室を選択してください</div>
            <div class="l-flex u-mt50">
              <div class="l-flex--clumn">
                <div class="l-flex">
                  <div class="c-label u-lh5">教室：</div>
                  <select tabindex="-1" name="r_roomName" id="room_name" class="c-comboBox c-comboBox--floorMap u-fz3 u-lh5">
                    <?php $rmsc->setCmbRoomName(); ?>
                  </select>
                </div>
                <div class="c-button c-button--floorMap u-mt50 u-fz3 u-lh5 u-textCenter" id="js-floormap_open">
                  フロアマップ
                </div>
              </div>
              <div class="l-flex">
                <div class="c-label u-lh5">使用理由：</div>
                <select tabindex="-1" name="r_reason" id="use_reason" class="c-comboBox u-fz3 u-lh5">
                  <?php $rmsc->setCmbReasonName(); ?>
                </select>
              </div>
            </div>
          </section>
          <!-- 退室予定時間選択 -->
          <section class="l-modal__page">
            <div class="c-label">退室予定時間を選択してください</div>
            <div class="l-flex  u-mt50">
              <select tabindex="-1" name="r_leavingTimeHour" id="leavetime_hour" class="c-comboBox c-comboBox-floorMap u-fz3 u-lh5">
                <?php $rmsc->setCmbHour(); ?>
              </select>
              <div class="c-label u-lh5">：</div>
              <select tabindex="-1" name="r_leavingTimeMinute" id="leavetime_min" class="c-comboBox c-comboBox-floorMap u-fz3 u-lh5">
                <?php $rmsc->setCmbMinute(); ?>
              </select>
            </div>
          </section>
          <div class="l-modal__page">
            <div class="c-label">教員番号を入力してください</div>
            <div class="c-textBox c-textBox--teacherCode u-mt50">
              <input tabindex="-1" name="r_entryTeacherCode" type="text" class="c-textBox" id="rteacher_code" onclick="SetTargetN('rteacher_code')" required="required" oncopy="return false" onpaste="return false" oninput="checkKey(this)" onfocus="blur()" />
              <div class="border-v">
                <div class="border-h"></div>
              </div>
            </div>
            <input tabindex="-1" type="submit" name="insert" value="" id="submit" />
          </div>
        </div>
      </div>
      <span class="p-modal__btn p-modal__btn--back u-hidden" id="js-enter_backbtn">戻る</span>
      <span class="p-modal__btn p-modal__btn--next" id="js-enter_nextbtn">次へ</span>
      <div class="p-modal__btn p-modal__btn--decision u-hidden" id="js-enter_decisionbtn">
        決定
      </div>
    </form>
    <?php require './model/RESERVATION_POST.php'; ?>
    <!-- フロアマップ -->
    <div class="l-background--floorMap u-hidden" id="js-floormap_back"></div>
    <div class="l-floorMap u-hidden" id="js-floormap">
      <div class="l-floorMap__closeBtn" id="js-floormap_close">×</div>
      <div class="l-floorMap__main u-absolute__center">
        <img src="./assets/f1.jpg" alt="" class="p-floorMapImg" />
        <img src="./assets/f2.jpg" alt="" class="p-floorMapImg u-none" />
        <img src="./assets/f3.jpg" alt="" class="p-floorMapImg u-none" />
        <img src="./assets/f4.jpg" alt="" class="p-floorMapImg u-none" />
        <img src="./assets/f5.jpg" alt="" class="p-floorMapImg u-none" />
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
    <div class="l-background--top u-hidden" id="js-entermini_back"></div>
    <div class="l-miniModal  u-absolute__center u-hidden" id="js-entermini">
      <div class="l-directionClumn u-vFill">
        <div class="l-modal__closeBtn" id="js-entermini_close">×</div>
        <div class="l-miniModal__top"></div>
        <div class="l-miniModal__body">
          <div class="c-label" id="js-decide_label"></div>
          <label for="submit">決定</label>
        </div>
      </div>
    </div>

    <!-- 退出画面 -->
    <form class="l-modal u-absolute--center u-top--50" id="js-exit">
      <div class="l-directionColumn u-hFill ">
        <div class="l-modal__closeBtn" id="js-exit_close">×</div>
        <div class="l-modal__top  u-hFill u-textCenter u-relative">
          <ol class="l-justifyCenter l-aiCenter u-vFill">
            <li class="p-progress p-progress--current js-exitProgress">氏名入力</li>
            <li class="p-progress js-exitProgress u-twoLines">学年・学科<br />選択</li>
          </ol>
        </div>
        <div class="l-modal__body l-flex u-fill" id="js-exit_body">
          <!-- 氏名入力 -->
          <section class="l-modal__page">
            <div class="c-label">氏名を入力してください</div>
            <div class="c-textBox c-textBox--firstName u-mt50" id="js-exit_firstName">
              <input tabindex="-1" name="l_firstName" type="text" class="c-textBox" id="lfirst_name" onclick="SetTargetC('lfirst_name')" required="required" oncopy="return false" onpaste="return false" oninput="checkKey(this)" onfocus="blur()" />
              <label class="first-name" for="lfirst_name">セイ</label>
              <div class="border-v">
                <div class="border-h"></div>
              </div>
            </div>
            <div class="c-textBox c-textBox--lastName u-mt50" id="js-llastName">
              <input tabindex="-1" name="l_lastName" type="text" class="c-textBox" id="llast_name" onclick="SetTargetC('llast_name')" required="required" oncopy="return false" onpaste="return false" oninput="checkKey(this)" onfocus="blur()" />
              <label class="first-name" for="llast_name">メイ</label>
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
              <select tabindex="-1" name="l_classYear" id="" class="c-comboBox c-comboBox--year u-fz3 u-lh5">
                <option value="1年">1年</option>
                <option value="2年">2年</option>
                <option value="3年">3年</option>
                <option value="4年">4年</option>
              </select>
            </div>
            <div class="l-flex u-mt50">
              <div class="c-label u-lh5">学科：</div>
              <select tabindex="-1" name="r_className" id="" class="c-comboBox c-comboBox--course u-fz3 u-lh5">
              </select>
            </div>
          </section>
        </div>
        <span class="p-modal__btn p-modal__btn--back u-hidden" id="js-exit_backbtn">戻る</span>
        <span class="p-modal__btn p-modal__btn--next" id="js-exit_nextbtn">次へ</span>
        <div class="p-modal__btn p-modal__btn--submit u-hidden">決定</div>
      </div>
    </form>

    <!-- 教員用画面 -->
    <form class="l-modal u-absolute--center u-top--50" id="js-teacher">
      <div class="l-directionColumn u-hFill ">
        <div class="l-modal__closeBtn" id="js-teacher_close">×</div>
        <div class="l-modal__top  u-hFill u-textCenter u-relative">
          <div class="c-label">先生を呼んできてください</div>
        </div>
        <div class="l-modal__body l-flex u-fill" id="js-teacherbody">
          <section class="l-modal__page">
            <div class="c-label">教員番号を入力してください</div>
            <div class="c-textBox c-textBox--teacherCode u-mt50">
              <input tabindex="-1" type="text" class="c-textBox" onclick="SetTargetN('teacher_code')" required="required" oncopy="return false" onpaste="return false" oninput="checkKey(this)" onfocus="blur()" />
              <div class="border-v">
                <div class="border-h"></div>
              </div>
            </div>
          </section>
          <section class="l-modal__page">
            <table></table>
          </section>
        </div>
        <span class="p-modal__btn p-modal__btn--back u-hidden" id="js-teacher_backbtn">戻る</span>
        <span class="p-modal__btn p-modal__btn--next" id="js-teacher_nextbtn">次へ</span>
        <div class="p-modal__btn p-modal__btn--submit u-hidden">決定</div>
      </div>
    </form>
  </main>
  <div class="l-keybordBack u-hidden" id="js-keybordback" onclick="HideKeybord()"></div>
  <!-- キーボード -->
  <div class="l-keybord u-absolute u-absolute--centerAuto u-bottom--m20r u-hidden" id="js-keybord">
    <div class="l-directionRowR u-vhFill">
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="BackSpace()">削除</button>
        <button class="l-keybord__btn" onclick="ToggleSize()">大/小</button>
        <button class="l-keybord__btn" onclick="ToggleDakuon()">
          ゛/ ゜
        </button>
        <button class="l-keybord__btn" onclick="Enter()" id="js-keybord--enter">次へ</button>
        <button class="l-keybord__btn" onclick="SetChar('ー')">ー</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('ア')">ア</button>
        <button class="l-keybord__btn" onclick="SetChar('イ')">イ</button>
        <button class="l-keybord__btn" onclick="SetChar('ウ')">ウ</button>
        <button class="l-keybord__btn" onclick="SetChar('エ')">エ</button>
        <button class="l-keybord__btn" onclick="SetChar('オ')">オ</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('カ')">カ</button>
        <button class="l-keybord__btn" onclick="SetChar('キ')">キ</button>
        <button class="l-keybord__btn" onclick="SetChar('ク')">ク</button>
        <button class="l-keybord__btn" onclick="SetChar('ケ')">ケ</button>
        <button class="l-keybord__btn" onclick="SetChar('コ')">コ</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('サ')">サ</button>
        <button class="l-keybord__btn" onclick="SetChar('シ')">シ</button>
        <button class="l-keybord__btn" onclick="SetChar('ス')">ス</button>
        <button class="l-keybord__btn" onclick="SetChar('セ')">セ</button>
        <button class="l-keybord__btn" onclick="SetChar('ソ')">ソ</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('タ')">タ</button>
        <button class="l-keybord__btn" onclick="SetChar('チ')">チ</button>
        <button class="l-keybord__btn" onclick="SetChar('ツ')">ツ</button>
        <button class="l-keybord__btn" onclick="SetChar('テ')">テ</button>
        <button class="l-keybord__btn" onclick="SetChar('ト')">ト</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('ナ')">ナ</button>
        <button class="l-keybord__btn" onclick="SetChar('ニ')">ニ</button>
        <button class="l-keybord__btn" onclick="SetChar('ヌ')">ヌ</button>
        <button class="l-keybord__btn" onclick="SetChar('ネ')">ネ</button>
        <button class="l-keybord__btn" onclick="SetChar('ノ')">ノ</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('ハ')">ハ</button>
        <button class="l-keybord__btn" onclick="SetChar('ヒ')">ヒ</button>
        <button class="l-keybord__btn" onclick="SetChar('フ')">フ</button>
        <button class="l-keybord__btn" onclick="SetChar('ヘ')">ヘ</button>
        <button class="l-keybord__btn" onclick="SetChar('ホ')">ホ</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('マ')">マ</button>
        <button class="l-keybord__btn" onclick="SetChar('ミ')">ミ</button>
        <button class="l-keybord__btn" onclick="SetChar('ム')">ム</button>
        <button class="l-keybord__btn" onclick="SetChar('メ')">メ</button>
        <button class="l-keybord__btn" onclick="SetChar('モ')">モ</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('ヤ')">ヤ</button>
        <button class="l-keybord__btn l-keybord__btn--hidden">&nbsp;</button>
        <button class="l-keybord__btn" onclick="SetChar('ユ')">ユ</button>
        <button class="l-keybord__btn l-keybord__btn--hidden">&nbsp;</button>
        <button class="l-keybord__btn" onclick="SetChar('ヨ')">ヨ</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('ラ')">ラ</button>
        <button class="l-keybord__btn" onclick="SetChar('リ')">リ</button>
        <button class="l-keybord__btn" onclick="SetChar('ル')">ル</button>
        <button class="l-keybord__btn" onclick="SetChar('レ')">レ</button>
        <button class="l-keybord__btn" onclick="SetChar('ロ')">ロ</button>
      </div>
      <div class="l-directionColumn u-vhFill l-keybordClumn">
        <button class="l-keybord__btn" onclick="SetChar('ワ')">ワ</button>
        <button class="l-keybord__btn l-keybord__btn--hidden">&nbsp;</button>
        <button class="l-keybord__btn" onclick="SetChar('ヲ')">ヲ</button>
        <button class="l-keybord__btn l-keybord__btn--hidden">&nbsp;</button>
        <button class="l-keybord__btn" onclick="SetChar('ノ')">ン</button>
      </div>
    </div>
  </div>

  <div class="l-keybordBack u-hidden" id="js-tenkeybordback" onclick="HideTenKeybord()"></div>
  <!-- テンキー -->
  <div class="l-tenkeybord l-directionColumn u-absolute u-absolute__bottomCenter u-hidden" id="js-tenkey">
    <div class="l-flex u-vQuatuor u-hFill">
      <button class="l-tenkeybord__btn" onclick="SetNumber('7')">7</button>
      <button class="l-tenkeybord__btn" onclick="SetNumber('8')">8</button>
      <button class="l-tenkeybord__btn" onclick="SetNumber('9')">9</button>
      <button class="l-tenkeybord__btn">&nbsp;</button>
    </div>
    <div class="l-flex u-vQuatuor u-hFill u-mt3">
      <button class="l-tenkeybord__btn" onclick="SetNumber('4')">4</button>
      <button class="l-tenkeybord__btn" onclick="SetNumber('5')">5</button>
      <button class="l-tenkeybord__btn" onclick="SetNumber('6')">6</button>
      <button class="l-tenkeybord__btn">&nbsp;</button>
    </div>
    <div class="l-flex u-vQuatuor u-hFill u-mt3">
      <button class="l-tenkeybord__btn" onclick="SetNumber('1')">1</button>
      <button class="l-tenkeybord__btn" onclick="SetNumber('2')">2</button>
      <button class="l-tenkeybord__btn" onclick="SetNumber('3')">3</button>
      <button class="l-tenkeybord__btn" onclick="BackSpaceN()">×</button>
    </div>
    <div class="l-flex u-vQuatuor u-hFill u-mt3">
      <button class="l-tenkeybord__btn">&nbsp;</button>
      <button class="l-tenkeybord__btn" onclick="SetNumber('0')">0</button>
      <button class="l-tenkeybord__btn">&nbsp;</button>
      <button class="l-tenkeybord__btn" onclick="EnterN()">確定</button>
    </div>
  </div>
  <script src="./script/script.js"></script>

</body>

</html>