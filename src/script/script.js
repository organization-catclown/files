const MAX_PAGE = 4
const MODAL_WIDTH = 1100
let currentPage = 0

const backBtn = document.getElementById("js-backBtn")
const nextBtn = document.getElementById("js-nextBtn")
const decisionBtn = document.getElementById("js-decisionBtn")
const modalBody = document.getElementById("js-modalBody")
const progress = document.getElementsByClassName("p-progress")

let target
const keybord = document.getElementById("js-keybord")
const keybordBack = document.getElementById("js-keybordBack")


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
  target = document.getElementById(id)
  target.classList.add("is-active")
  keybord.classList.remove("u-hidden")
  keybordBack.classList.remove("u-hidden")
  if(target.classList.contains("c-textBox--lastName")) {
    document.body.style.top = "-5rem"
  }
}

function hideKeybord() {
  target.classList.remove("is-active")
  keybord.classList.add("u-hidden")
  keybordBack.classList.add("u-hidden")
}

function setChar(char) { 
  target.value += char
}

function backSpace() {
  let len = target.value.length
  let lastc = target.value.substring(len-1, len)
  target.value = target.value.substring(0, len-1)
}

function toggleSize() {
  let len = target.value.length
  let lastc = target.value.substring(len-1, len)
  switch(lastc) {
    case "ヤ":
      lastc = "ャ"
      break
    case "ャ":
      lastc = "ヤ"
      break
    case "ユ":
      lastc = "ュ"
      break
    case "ュ":
      lastc = "ユ"
      break
    case "ヨ":
      lastc = "ョ"
      break
    case "ョ":
      lastc = "ヨ"
      break
  }
  backSpace()
  target.value += lastc
}

function toggleDakuon() {
  let len = target.value.length
  let lastc = target.value.substring(len-1, len)
  switch(lastc) {
    case "カ":
      lastc = "ガ"
      break
    case "ガ":
      lastc = "カ"
      break
    case "キ":
      lastc = "ギ"
      break
    case "ギ":
      lastc = "キ"
      break
    case "ク":
      lastc = "グ"
      break
    case "グ":
      lastc = "ク"
      break
    case "ケ":
      lastc = "ゲ"
      break
    case "ゲ":
      lastc = "ケ"
      break
    case "コ":
      lastc = "ゴ"
      break
    case "ゴ":
      lastc = "コ"
      break
    case "サ":
      lastc = "ザ"
      break
    case "ザ":
      lastc = "サ"
      break
    case "シ":
      lastc = "ジ"
      break
    case "ジ":
      lastc = "シ"
      break
    case "ス":
      lastc = "ズ"
      break
    case "ズ":
      lastc = "ス"
      break
    case "セ":
      lastc = "ゼ"
      break
    case "ゼ":
      lastc = "セ"
      break
    case "ソ":
      lastc = "ゾ"
      break
    case "ゾ":
      lastc = "ソ"
      break
    case "タ":
      lastc = "ダ"
      break
    case "ダ":
      lastc = "タ"
      break
    case "チ":
      lastc = "ヂ"
      break
    case "ヂ":
      lastc = "チ"
      break
    case "ツ":
      lastc = "ヅ"
      break
    case "ヅ":
      lastc = "ツ"
      break
    case "テ":
      lastc = "デ"
      break
    case "デ":
      lastc = "テ"
      break
    case "ト":
      lastc = "ド"
      break
    case "ド":
      lastc = "ト"
      break
    case "ハ":
      lastc = "バ"
      break
    case "バ":
      lastc = "パ"
      break
    case "パ":
      lastc = "ハ"
      break
    case "ヒ":
      lastc = "ビ"
      break
    case "ビ":
      lastc ="ピ"
      break
    case "ピ":
      lastc = "ヒ"
      break
    case "フ":
      lastc = "ブ"
      break
    case "ブ":
      lastc = "プ"
      break
    case "プ":
      lastc = "フ"
      break
    case "ヘ":
      lastc = "ベ"
      break
    case "ベ":
      lastc = "ペ"
      break
    case "ペ":
      lastc = "ヘ"
      break
    case "ホ":
      lastc = "ボ"
      break
    case "ボ":
      lastc = "ポ"
      break
    case "ポ":
      lastc = "ホ"
      break
  }
  backSpace()
  target.value += lastc
}

function enter() {
  hideKeybord()
}
