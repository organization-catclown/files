document.getElementById("sei").onclick = () => {
  // キーボード表示
  let kb = document.getElementById("keybord")
  kb.classList.add("is-show")
  kb.style.transform = "translateX(0)"
  kb.style.transition = "translateX 2s;"
  
  // 影表示
  target = document.getElementById("sei")
  target.style.boxShadow = "0 0 10px 5px rgba(97, 205, 255, 0.3)"  
  
  // seilabel上に移動
  let sl = document.getElementById("seilabel")
  sl.style.transform = "translateY(-2em)"
  sl.style.color = "#000"
  sl.style.fontSize = "0.8em"
  sl.style.transition = "transform .7s, color .7s"

  // meilabel元に戻す
  let ml = document.getElementById("meilabel")
  if(document.getElementById("mei").innerText.length) {
    ml.style.color = "transparent"
  }else{
    ml.style.transform = "translateY(0)"
    ml.style.color = "#999"
    ml.style.fontSize = "1em"
    ml.style.transition = "transform 1s, color 1s"
  }
  //mei影なくす
  document.getElementById("mei").style.boxShadow = "initial"
}


document.getElementById("mei").onclick = () => {
  // キーボード表示
  let kb = document.getElementById("keybord")
  kb.classList.add("is-show")
  kb.style.transform = "translateX(24.5em)"
  kb.style.transition = "translateX .3s"

  // 影表示
  target = document.getElementById("mei")
  target.style.boxShadow = "0 0 10px 5px rgba(97, 205, 255, 0.3)"

  // seilabel上に移動
  let ml = document.getElementById("meilabel")
  ml.style.transform = "translateY(-2em)"
  ml.style.color = "#000"
  ml.style.fontSize = "0.8em"
  ml.style.transition = "transform .7s, color .7s"

  // seilabel元に戻す
  let sl = document.getElementById("seilabel")
  if(document.getElementById("sei").innerText.length) {
    sl.style.color = "transparent"
  }else{
    sl.style.transform = "translateY(0)"
    sl.style.color = "#999"
    sl.style.fontSize = "1em"
    sl.style.transition = "transform 1s, color 1s"
  }

  // sei影なくす
  document.getElementById("sei").style.boxShadow = "initial"
}


document.getElementById("close").onclick = () => {
  // キーボード非表示
  document.getElementById("keybord").classList.remove("is-show")
  
  let sl = document.getElementById("seilabel")
  let ml = document.getElementById("meilabel")
  
  // sailabel戻す
  if(document.getElementById("sei").innerText.length) {
    sl.style.color = "transparent"
  }else{
    sl.style.transform = "translateY(0)"
    sl.style.color = "#999"
    sl.style.fontSize = "1em"
    sl.style.transition = "transform 1s, color 1s"
  }
  // smeilabel戻す
  if(document.getElementById("mei").innerText.length) {
    ml.style.color = "transparent"
  }else{
    ml.style.transform = "translateY(0)"
    ml.style.color = "#999"
    ml.style.fontSize = "1em"
    ml.style.transition = "transform 1s, color 1s"
  }
  
  // 影なくす
  document.getElementById("mei").style.boxShadow = "initial"
  document.getElementById("sei").style.boxShadow = "initial"
}


function addChar(char) {
  let disp = target
  disp.innerText += char
}

document.getElementById("change").onclick = () =>{
  let disp = target
  disp.innerText = disp.innerText.substr(0, disp.innerText.length - 1) + changeChar(disp.innerText.substr(disp.innerText.length - 1))
}

function changeChar(char) {
  switch(char) {
    case "ツ":
      return "ッ"
    case "ッ":
      return "ツ"
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
      return char
  }
}

document.getElementById("dakuten").onclick = () => {
  let disp = target
  disp.innerText = disp.innerText.substr(0, disp.innerText.length - 1) + dakuten(disp.innerText.substr(disp.innerText.length - 1))
}

function dakuten(char) {
  switch(char) {
    // カ行
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
    // サ行
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
    // タ行
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
    // ハ行
    case "ハ":
      return "バ"
    case "ヒ":
      return "ビ"
    case "フ":
      return "ブ"
    case "ヘ":
      return "ベ"
    case "ホ":
      return "ボ"
    // バ行
    case "バ":
      return "パ"
    case "ビ":
      return "ピ"
    case "ブ":
      return "プ"
    case "ベ":
      return "ペ"
    case "ボ":
      return "ポ"
    // パ行
    case "パ":
      return "ハ"
    case "ピ":
      return "ヒ"
    case "プ":
      return "フ"
    case "ペ":
      return "ヘ"
    case "ポ":
      return "ホ"
    default:
      return char
  }
}

document.getElementById("del").onclick = () => {
  let disp = target
  disp.innerText = disp.innerText.length > 1 ? disp.innerText.substr(0, disp.innerText.length - 1) : ""
}
