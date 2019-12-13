const MODAL_WIDTH    = 1100
const ENTER_MAX_PAGE = 4
let enterCurrentPage = 0
const EXIT_MAX_PAGE  = 2
let exitCurrentPage  = 0

let enterMiniModal
let enterMiniClose

let floorMapBack
let floorMapBody
let floorMapClose

let exitModal
let exitBackBtn
let exitNextBtn

let teacherModal


// --------------------DOMがロードされた後変数代入(null代入防止)--------------------
const AssignDOM = () => {
  modalBack = document.getElementById("js-modal_back")

  enterModal = document.getElementById("js-enter")
  enterBackBtn = document.getElementById("js-enter_backbtn")
  enterNextBtn = document.getElementById("js-enter_nextbtn")
  enterCloseBtn = document.getElementById("js-enter_close")

  exitModal = document.getElementById("js-exit")
  exitBackBtn = document.getElementById("js-exit_backbtn")
  exitNextBtn = document.getElementById("js-exit_nextbtn")

  teacherModal = document.getElementById("js-teacher")
}
document.addEventListener("DOMContentLoaded", AssignDOM(), false)

// --------------------全角入力制限--------------------
function checkKey(string) {
  let str = string.value
  console.log(str);
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
const MovementModal = (el, dist) => {
  el.style.transform = "translateX(" + -MODAL_WIDTH * dist + "px)"
}

// ============================================================
//                     入室画面関連
// ============================================================

// --------------------入室画面表示--------------------
const ShowEnter = () => {
  const enterModal = document.getElementById("js-enter")
  const modalBack = document.getElementById("js-modal_back")

  enterModal.classList.remove("u-hidden")
  modalBack.classList.remove("u-hidden")
}

// --------------------クローズボタン押下時--------------------
document.getElementById("js-enter_close").addEventListener("click", function () {
  const enterModal = document.getElementById("js-enter")
  const modalBack = document.getElementById("js-modal_back")

  enterModal.classList.add("u-hidden")
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
  console.log(enterCurrentPage);
  
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
  const leaveTimeSec = document.getElementById("leavetime_sec").value
  const leaveTime = leaveTimeHour + " ： " + leaveTimeSec

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


// ============================================================
//                     退室画面関連
// ============================================================


// ============================================================
//                     教員用画面関連
// ============================================================


// ============================================================
//                     キーボード関連
// ============================================================
let target = null

// --------------------テキストインプット選択時--------------------
const SetTargetC = id => {
  const keybord = document.getElementById("js-keybord")
  const keybordBack = document.getElementById("js-keybordback")
  
  event.returnValue = false
  target = document.getElementById(id)
  target.classList.add("is-active")
  keybord.classList.remove("u-hidden")
  keybordBack.classList.remove("u-hidden")
  if (id == "rlast_name") { modal.style.top = "40%" }
  if (id == "llast_name") { rmodal.style.top = "40%" }
}

// --------------------キーボード非表示--------------------
const HideKeybord = () => {
  const keybord = document.getElementById("js-keybord")
  const keybordBack = document.getElementById("js-keybordback")
  
  target.classList.remove("is-active")
  keybord.classList.add("u-hidden")
  keybordBack.classList.add("u-hidden")
  modal.style.top = "50%"
  rmodal.style.top = "50%"
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
const BackSapce = () => {
  const len = target.value.length
  target.value = target.value.substring(0, len - 1)
}

// ============================================================
//                     テンキー関連
// ============================================================