const MAX_PAGE = 4
const MODAL_WIDTH = 1100
let currentPage = 0

const backBtn = document.getElementById("js-backBtn")
const nextBtn = document.getElementById("js-nextBtn")
const decisionBtn = document.getElementById("js-decisionBtn")
const modal = document.getElementById("js-enter")
const modalBody = document.getElementById("js-modalBody")
const progress = document.getElementsByClassName("p-progress")

let target
const keybord = document.getElementById("js-keybord")
const keybordBack = document.getElementById("js-keybordBack")


function checkKey(string) {
  let str = string.value
  console.log(str);
  while (str.match(/[^A-Z^a-z\d\-]/)) {
    str = str.replace(/[^A-Z^a-z\d\-]/, "");
  }
  string.value = str;
}

// window.document.onkeydown = function (e) {
//   return false;
// }

document.oncontextmenu = function () { return false; }

backBtn.addEventListener("click", function () {
  if (currentPage > 0) {
    currentPage--
    if (nextBtn.classList.contains("u-hidden")) {
      nextBtn.classList.remove("u-hidden")
      decisionBtn.classList.add("u-hidden")

      document.getElementsByClassName("l-modal__top")[0].classList.remove("u-none")
      document.getElementsByClassName("l-modal__top")[1].classList.add("u-none")
    }

    modalBody.style.transform = "translateX(" + -MODAL_WIDTH * currentPage + "px)"
    progress[currentPage].classList.add("p-progress--current")
    progress[currentPage + 1].classList.remove("p-progress--current")
    progress[currentPage].classList.remove("p-progress--done")
  }
  if (currentPage == 0) backBtn.classList.add("u-hidden")
}, false)

nextBtn.addEventListener("click", function () {
  if (currentPage < MAX_PAGE - 1) {
    currentPage++
    if (backBtn.classList.contains("u-hidden")) backBtn.classList.remove("u-hidden")

    modalBody.style.transform = "translateX(" + -MODAL_WIDTH * currentPage + "px)"
    progress[currentPage].classList.add("p-progress--current")
    progress[currentPage - 1].classList.remove("p-progress--current")
    progress[currentPage - 1].classList.add("p-progress--done")
  }
  if (currentPage == MAX_PAGE - 1) {
    nextBtn.classList.add("u-hidden")
    decisionBtn.classList.remove("u-hidden")
  }

}, false)

decisionBtn.addEventListener("click", function () {
  if (currentPage < MAX_PAGE) {
    currentPage++
    modalBody.style.transform = "translateX(" + -MODAL_WIDTH * currentPage + "px)"

    document.getElementsByClassName("l-modal__top")[0].classList.add("u-none")
    document.getElementsByClassName("l-modal__top")[1].classList.remove("u-none")
  } else if (currentPage == MAX_PAGE) {
    document.getElementById("js-enterMiniBack").classList.remove("u-hidden")
    document.getElementById("js-enterMini").classList.remove("u-hidden")

  }
}, false)

const closeMini = document.getElementById("js-enterMiniClose")
closeMini.addEventListener("click", function () {
  document.getElementById("js-enterMiniBack").classList.add("u-hidden")
  document.getElementById("js-enterMini").classList.add("u-hidden")
}, false)


const enterClose = document.getElementById("js-enterClose")
enterClose.addEventListener("click", function () {
  document.getElementById("js-enter").classList.add("u-hidden")
  document.getElementById("js-enterBack").classList.add("u-hidden")
}, false)

function showEnter() {
  document.getElementById("js-enter").classList.remove("u-hidden")
  document.getElementById("js-enterBack").classList.remove("u-hidden")
}

function showExit() {
  document.getElementById("js-exit").classList.remove("u-hidden")
  document.getElementById("js-exitBack").classList.remove("u-hidden")
}

function showTeacher() {
  document.getElementById("js-teacher").classList.remove("u-hidden")
  document.getElementById("js-teacherBack").classList.remove("u-hidden")
}

const floorMapOpen = document.getElementById("js-floorMapOpen")
floorMapOpen.addEventListener("click", function () {
  document.getElementById("js-floorMapBack").classList.remove("u-hidden")
  document.getElementById("js-floorMap").classList.remove("u-hidden")
}, false)

const floorMapClose = document.getElementById("js-floorMapClose")
floorMapClose.addEventListener("click", function () {
  document.getElementById("js-floorMap").classList.add("u-hidden")
  document.getElementById("js-floorMapBack").classList.add("u-hidden")
}, false)

const exitClose = document.getElementById("js-exitClose")
exitClose.addEventListener("click", function () {
  document.getElementById("js-exit").classList.add("u-hidden")
  document.getElementById("js-exitBack").classList.add("u-hidden")
}, false)

const teacherClose = document.getElementById("js-teacherClose")
teacherClose.addEventListener("click", function () {
  document.getElementById("js-teacher").classList.add("u-hidden")
  document.getElementById("js-teacherBack").classList.add("u-hidden")
}, false)

function setTargetC(id) {
  event.returnValue = false
  target = document.getElementById(id)
  target.classList.add("is-active")
  keybord.classList.remove("u-hidden")
  keybordBack.classList.remove("u-hidden")
  if (id == "last_name") {
    modal.style.top = "40%"
  }
}

function hideKeybord() {
  target.classList.remove("is-active")
  keybord.classList.add("u-hidden")
  keybordBack.classList.add("u-hidden")
  modal.style.top = "50%"
}

function setChar(char) {
  target.value += char
}

function backSpace() {
  let len = target.value.length
  target.value = target.value.substring(0, len - 1)
}

function toggleSize() {
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

function toggleDakuon() {
  let lastc = dakuten()
  backSpace()
  target.value += lastc
}

function dakuten() {
  let len = target.value.length
  let lastc = target.value.substring(len - 1, len)
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

function enter() {
  hideKeybord()
}

function setTargetN(id) {
  target = document.getElementById(id)
  target.classList.add("is-active")
  keybord.classList.remove("u-hidden")
  keybordBack.classList.remove("u-hidden")
}

const decideBtn = document.getElementById("js-decisionBtn")
decideBtn.addEventListener("click", function () {
  const firstName = document.getElementById("first_name").value
  const lastName = document.getElementById("last_name").value
  const fullName = firstName + " " + lastName
  const classYear = document.getElementById("class_year").value

  console.log(firstName, lastName);
  document.getElementById("decide_label").innerText = "名前： " + fullName + "\n学年： " + classYear +
    "\n学科： "

}, false)
