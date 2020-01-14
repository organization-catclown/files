const MODAL_WIDTH    = 1100

let floorMapBack
let floorMapBody
let floorMapClose

let exitModal
let exitBackBtn
let exitNextBtn


// --------------------全角入力制限--------------------
/**
 * @param  {String} string 入力文字列 引数
 */
function checkKey(string) {
  let str = string.value
  while (str.match(/[^A-Z^a-z\d\-]/)) {
    str = str.replace(/[^A-Z^a-z\d\-]/, "");
  }
  string.value = str;
}

// --------------------キー入力制限--------------------
// window.document.onkeydown = function (e) {
//   return false;
// }

// --------------------右クリック禁止--------------------
document.oncontextmenu = function () { return false; }


// --------------------モーダル移動--------------------
/**
 * @param  {Node} el 移動モーダルボディー 引数
 * @param  {Integer} dist 移動距離 引数
 */
const MovementModal = (el, dist) => {
  el.style.transform = "translateX(" + -MODAL_WIDTH * dist + "px)"
  el.style.transition = ".2s"
}


// ============================================================
//                     入室画面関連
// ============================================================
const ENTER_MAX_PAGE = 4
let enterCurrentPage = 0

// --------------------入室画面表示--------------------
const ShowEnter = () => {
  const enterModal = document.getElementById("js-enter")
  const modalBack = document.getElementById("js-modal_back")

  enterModal.classList.remove("a-fade--out")
  enterModal.classList.add("a-fade--in")
  modalBack.classList.remove("u-hidden")
}

// --------------------クローズボタン押下時--------------------
document.getElementById("js-enter_close").addEventListener("click", function () {
  const enterModal = document.getElementById("js-enter")
  const modalBack = document.getElementById("js-modal_back")

  enterModal.classList.add("a-fade--out")
  enterModal.classList.remove("a-fade--in")
  modalBack.classList.add("u-hidden")
}, false)

// -------------------戻るボタン押下時--------------------
document.getElementById("js-enter_backbtn").addEventListener("click", function () {
  const enterBody = document.getElementById("js-enter_body")
  const enterNextBtn = document.getElementById("js-enter_nextbtn")
  const enterDecisionBtn = document.getElementById("js-enter_decisionbtn") 
  const progress = document.getElementsByClassName("js-enterProgress")
  
  if (enterCurrentPage > 0) {
    enterCurrentPage--
    
    MovementModal(enterBody, enterCurrentPage)
    progress[enterCurrentPage].classList.add("p-progress--current")
    progress[enterCurrentPage + 1].classList.remove("p-progress--current")
    progress[enterCurrentPage].classList.remove("p-progress--done")

    if(enterNextBtn.classList.contains("u-hidden") && enterCurrentPage<ENTER_MAX_PAGE-1) {
      enterNextBtn.classList.remove("u-hidden")
      enterDecisionBtn.classList.add("u-hidden")
    }
  }
  if(enterCurrentPage == 0) {
    this.classList.add("u-hidden")
  }
}, false)

// --------------------次へボタン押下時--------------------
document.getElementById("js-enter_nextbtn").addEventListener("click", function(){
  const enterBody = document.getElementById("js-enter_body")
  const progress = document.getElementsByClassName("js-enterProgress")
  const enterBackBtn = document.getElementById("js-enter_backbtn")
  const enterDecisionBtn = document.getElementById("js-enter_decisionbtn") 

  if(enterCurrentPage<ENTER_MAX_PAGE-1) {
    enterCurrentPage++

    if(enterBackBtn.classList.contains("u-hidden")) {
      enterBackBtn.classList.remove("u-hidden")
    }

    MovementModal(enterBody, enterCurrentPage)
    progress[enterCurrentPage].classList.add("p-progress--current")
    progress[enterCurrentPage - 1].classList.remove("p-progress--current")
    progress[enterCurrentPage - 1].classList.add("p-progress--done")
  }
  if(enterCurrentPage == ENTER_MAX_PAGE -1) {
    this.classList.add("u-hidden")
    enterDecisionBtn.classList.remove("u-hidden")
  }
}, false)

// --------------------決定ボタン押下時--------------------
document.getElementById("js-enter_decisionbtn").addEventListener("click", function(){
  const enterBody = document.getElementById("js-enter_body")
  
  if(enterCurrentPage == ENTER_MAX_PAGE){
    ShowEnterMini()
  }else{
    enterCurrentPage++
    MovementModal(enterBody, enterCurrentPage)
  }
}, false)


// ============================================================
//                     入室確認画面関連
// ============================================================

// --------------------入室確認画面表示--------------------
const ShowEnterMini = () => {
  const enterMini = document.getElementById("js-entermini")
  const enterMiniBack = document.getElementById("js-entermini_back")
  const decisionLabel = document.getElementById("js-decide_label")

  enterMini.classList.remove("u-hidden")
  enterMiniBack.classList.remove("u-hidden")

  const firstName = document.getElementById("rfirst_name").value
  const lastName = document.getElementById("rlast_name").value
  const fullName = firstName + " " + lastName
  const classYear = document.getElementById("class_year").value
  const className = document.getElementById("class_name").value
  const roomName = document.getElementById("room_name").value
  const reason = document.getElementById("use_reason").value
  const leaveTimeHour = document.getElementById("leavetime_hour").value
  const leaveTimeMinutes = document.getElementById("leavetime_min").value
  const leaveTime = leaveTimeHour + " ： " + leaveTimeMinutes

  decisionLabel.innerText = "名前： " + fullName + "\n学年： " + classYear +
    "\n学科： " + className + "\n使用教室： " + roomName + "\n使用理由： " + reason + "\n退室予定時間： " + leaveTime
}

// --------------------クローズボタン押下時--------------------
document.getElementById("js-entermini_close").addEventListener("click", function(){
  const enterMini = document.getElementById("js-entermini")
  const enterMiniBack = document.getElementById("js-entermini_back")

  enterMini.classList.add("u-hidden")
  enterMiniBack.classList.add("u-hidden")
} ,false)


// ============================================================
//                     フロアマップ関連
// ============================================================

// --------------------フロアマップ表示--------------------
document.getElementById("js-floormap").addEventListener("click", function() {
  return true
}, false)



// ============================================================
//                     退室画面関連
// ============================================================
const EXIT_MAX_PAGE  = 2
let exitCurrentPage  = 0

// --------------------退室画面表示--------------------
const ShowExit = () => {
  const exitModal = document.getElementById("js-exit")
  const modalBack = document.getElementById("js-modal_back")
  
  exitModal.classList.add("a-fade--in")
  exitModal.classList.remove("a-fade--out")
  modalBack.classList.remove("u-hidden")
}

// --------------------クローズボタン押下時--------------------
document.getElementById("js-exit_close").addEventListener("click", function() {
  const exitModal = document.getElementById("js-exit")
  const modalBack = document.getElementById("js-modal_back")
  
  exitModal.classList.add("a-fade--out")
  exitModal.classList.remove("a-fade--in")
  modalBack.classList.add("u-hidden")
}, false)


// --------------------戻るボタン押下時--------------------
document.getElementById("js-exit_backbtn").addEventListener("click", function(){
  const exitBody = document.getElementById("js-exit_body")
  const exitNextBtn = document.getElementById("js-exit_nextbtn")
  const progress = document.getElementsByClassName("js-exitProgress")

  if(exitCurrentPage > 0) {
    exitCurrentPage--

    if(exitNextBtn.classList.contains("u-hidden")) {
      exitNextBtn.classList.remove("u-hidden")
    }

    MovementModal(exitBody, exitCurrentPage)
    progress[exitCurrentPage].classList.add("p-progress--current")
    progress[exitCurrentPage + 1].classList.remove("p-progress--current")
    progress[exitCurrentPage].classList.remove("p-progress--done")
  }
  if(exitCurrentPage == 0) {
    this.classList.add("u-hidden")
  }
}, false)

// --------------------次へボタン押下時--------------------
document.getElementById("js-exit_nextbtn").addEventListener("click", function(){
  const exitBody = document.getElementById("js-exit_body")
  const exitBackBtn = document.getElementById("js-exit_backbtn")
  const progress = document.getElementsByClassName("js-exitProgress")

  if(exitCurrentPage<EXIT_MAX_PAGE-1) {
    exitCurrentPage++

    if(exitBackBtn.classList.contains("u-hidden")) {
      exitBackBtn.classList.remove("u-hidden")
    }

    MovementModal(exitBody, exitCurrentPage)
    progress[exitCurrentPage].classList.add("p-progress--current")
    progress[exitCurrentPage - 1].classList.remove("p-progress--current")
    progress[exitCurrentPage - 1].classList.add("p-progress--done")
  }
  if(exitCurrentPage == EXIT_MAX_PAGE -1) {
    this.classList.add("u-hidden")
  }
}, false)

// --------------------決定ボタン押下時--------------------


// ============================================================
//                     教員用画面関連
// ============================================================

// --------------------教員用画面表示--------------------
const ShowTeacher = () => {
  const teacherModal = document.getElementById("js-teacher") 
  const modalBack = document.getElementById("js-modal_back")
  
  teacherModal.classList.add("a-fade--in")
  teacherModal.classList.remove("a-fade--out")
  modalBack.classList.remove("u-hidden")
}

// --------------------クローズボタン押下時--------------------
document.getElementById("js-teacher_close").addEventListener("click", function() {
  const teacherModal = document.getElementById("js-teacher") 
  const modalBack = document.getElementById("js-modal_back")
  
  teacherModal.classList.add("a-fade--out")
  teacherModal.classList.remove("a-fade--in")
  modalBack.classList.add("u-hidden")
}, false)



// --------------------戻るボタン押下時--------------------

// --------------------次へボタン押下時--------------------

// --------------------決定ボタン押下時--------------------

// ============================================================
//                     キーボード関連
// ============================================================
let target = null

// --------------------テキストインプット選択時--------------------
/**
 * @param  {String} id 入力先のinputのid 引数
 */
const SetTargetC = id => {
  const enterModal = document.getElementById("js-enter")
  const exitModal = document.getElementById("js-exit")
  const keybord = document.getElementById("js-keybord")
  const keybordBack = document.getElementById("js-keybordback")

  event.returnValue = false
  target = document.getElementById(id)
  target.classList.add("is-active")
  keybord.classList.remove("u-hidden")
  keybord.classList.add("a-fade--up")
  keybord.classList.remove("a-fade--down")
  keybordBack.classList.remove("u-hidden")

  if (id == "rlast_name") { enterModal.style.top = "40%" }
  if (id == "llast_name") { exitModal.style.top = "40%" }
}

// --------------------キーボード非表示--------------------
const HideKeybord = () => {
  const enterModal = document.getElementById("js-enter")
  const exitModal = document.getElementById("js-exit")
  const keybord = document.getElementById("js-keybord")
  const keybordBack = document.getElementById("js-keybordback")
  
  target.classList.remove("is-active")
  keybord.classList.add("a-fade--down")
  keybord.classList.remove("a-fade--up")
  keybord.classList.add("u-hidden")
  keybordBack.classList.add("u-hidden")
  enterModal.style.top = "50%"
  exitModal.style.top = "50%"
}

// --------------------入力--------------------
const SetChar = char => {
  target.value += char
}

// --------------------大/小切り替え--------------------
function ToggleSize() {
  let lastc = cSize()
  backSpace()
  target.value += lastc
}

function cSize() {
  let len = target.value.length
  let lastc = target.value.substring(len - 1, len)
  switch (lastc) {
    case "ヤ":
      return "ャ"
    case "ャ":
      return "ヤ"
    case "ユ":
      return "ュ"
    case "ュ":
      return "ユ"
    case "ヨ":
      return "ョ"
    case "ョ":
      return "ヨ"
    default:
      return lastc
  }
}

// --------------------ﾞ / ﾟ切り替え--------------------
const ToggleDakuon = () => {
  const lastc = dakuten()
  backSpace()
  target.value += lastc
}

const Dakuten = () => {
  const len = target.value.length
  const lastc = target.value.substring(len - 1, len)
  switch (lastc) {
    case "カ":
      return "ガ"
    case "ガ":
      return "カ"
    case "キ":
      return "ギ"
    case "ギ":
      return "キ"
    case "ク":
      return "グ"
    case "グ":
      return "ク"
    case "ケ":
      return "ゲ"
    case "ゲ":
      return "ケ"
    case "コ":
      return "ゴ"
    case "ゴ":
      return "コ"
    case "サ":
      return "ザ"
    case "ザ":
      return "サ"
    case "シ":
      return "ジ"
    case "ジ":
      return "シ"
    case "ス":
      return "ズ"
    case "ズ":
      return "ス"
    case "セ":
      return "ゼ"
    case "ゼ":
      return "セ"
    case "ソ":
      return "ゾ"
    case "ゾ":
      return "ソ"
    case "タ":
      return "ダ"
    case "ダ":
      return "タ"
    case "チ":
      return "ヂ"
    case "ヂ":
      return "チ"
    case "ツ":
      return "ヅ"
    case "ヅ":
      return "ツ"
    case "テ":
      return "デ"
    case "デ":
      return "テ"
    case "ト":
      return "ド"
    case "ド":
      return "ト"
    case "ハ":
      return "バ"
    case "バ":
      return "パ"
    case "パ":
      return "ハ"
    case "ヒ":
      return "ビ"
    case "ビ":
      return "ピ"
    case "ピ":
      return "ヒ"
    case "フ":
      return "ブ"
    case "ブ":
      return "プ"
    case "プ":
      return "フ"
    case "ヘ":
      return "ベ"
    case "ベ":
      return "ペ"
    case "ペ":
      return "ヘ"
    case "ホ":
      return "ボ"
    case "ボ":
      return "ポ"
    case "ポ":
      return "ホ"
    default:
      return lastc
  }
}

// --------------------バックスペース--------------------
const BackSpace = () => {
  const len = target.value.length
  target.value = target.value.substring(0, len - 1)
}

const Enter = () => {
  if(target == document.getElementById("rfirst_name")) {
    const enterModal = document.getElementById("js-enter")

    target.classList.remove("is-active")
    target = document.getElementById("rlast_name")
    target.classList.add("is-active")
    enterModal.style.top = "40%"
  }else if(target == document.getElementById("rlast_name")){
    const enterModal = document.getElementById("js-enter")
    const enterBody = document.getElementById("js-enter_body")
    const enterBackBtn = document.getElementById("js-enter_backbtn")
    const progress = document.getElementsByClassName("js-enterProgress")

    target.classList.remove("is-active")
    enterModal.style.top = "50%"
    HideKeybord()
    enterCurrentPage++
    MovementModal(enterBody, enterCurrentPage)
    progress[enterCurrentPage].classList.add("p-progress--current")
    progress[enterCurrentPage - 1].classList.remove("p-progress--current")
    progress[enterCurrentPage - 1].classList.add("p-progress--done")
    enterBackBtn.classList.remove("u-hidden")
  }else if(target == document.getElementById("lfirst_name")) {
    const exitModal = document.getElementById("js-exit")

    target.classList.remove("is-active")
    target = document.getElementById("llast_name")
    target.classList.add("is-active")
    exitModal.style.top = "40%"
  }else if(target == document.getElementById("llast_name")) {
    const exitModal = document.getElementById("js-exit")
    const exitBody = document.getElementById("js-exit_body")
    const exitBackBtn = document.getElementById("js-exit_backbtn")
    const exitNextBtn = document.getElementById("js-exit_nextbtn")
    const progress = document.getElementsByClassName("js-exitProgress")

    target.classList.remove("is-active")
    exitModal.style.top = "50%"
    HideKeybord()
    exitCurrentPage++
    MovementModal(exitBody, exitCurrentPage)
    progress[exitCurrentPage].classList.add("p-progress--current")
    progress[exitCurrentPage - 1].classList.remove("p-progress--current")
    progress[exitCurrentPage - 1].classList.add("p-progress--done")
    exitBackBtn.classList.remove("u-hidden")
    exitNextBtn.classList.add("u-hidden")
  }
}


// ============================================================
//                     テンキー関連
// ============================================================
let targetN = null

// --------------------テンキー表示--------------------
/**
 * @param  {String} id 入力先のinputのid 引数
 */
const SetTargetN = id => {
  const tenkey = document.getElementById("js-tenkey")
  const tenkeyBack = document.getElementById("js-tenkeybordback")

  targetN = document.getElementById(id)
  targetN.classList.add("is-active")
  tenkey.classList.remove("u-hidden")
  tenkeyBack.classList.remove("u-hidden")  
}

// --------------------入力--------------------
const SetNumber = n => {
  targetN.value += n
}

// --------------------バックスペース--------------------
const BackSpaceN = () => {
  const len = targetN.value.length
  targetN.value = targetN.value.substring(0, len - 1)
}

// --------------------テンキー非表示--------------------
const HideTenKeybord = () => {
  const tenkey = document.getElementById("js-tenkey")
  const tenkeyBack = document.getElementById("js-tenkeybordback")

  targetN.classList.remove("is-active")
  tenkey.classList.add("u-hidden")
  tenkeyBack.classList.add("u-hidden")
}

// --------------------確定--------------------
const EnterN = () => {
  HideTenKeybord()
}