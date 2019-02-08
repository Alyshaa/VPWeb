
onload = e =>{
  var main = document.querySelector('main');
  var loginWraper = document.createElement('div');
  var inputWraper = document.createElement('div');
  inputWraper.className='inputWraper';
  loginWraper.className='loginWraper';


  var login = document.createElement('button');
  login.innerText = 'Login';
  login.className='loginbtn';
  login.onclick = e=>{
    MakeLogin();
  }

  inputWraper.append(login);

  loginWraper.append(inputWraper);
  main.append(loginWraper);
}

function MakeLogin() {
  var main = document.querySelector('main');
  var loginWraper = document.querySelector('.loginWraper');
  var inputWraper = document.querySelector('.inputWraper');
  inputWraper.innerHTML = '';
  var form, inPW, sub, errorWraper;



  //Password Input
  {
    inPW = document.createElement('input');
    inPW.className='textfield';
    inPW.type='password';
    inPW.placeholder = 'Password';
    inPW.id = 'Password';
  }

  //Submit Button
  {
    sub = document.createElement('button');
    sub.className='loginbtn abstandlogin';
    sub.type='button';
    sub.innerText = 'Login';
    sub.onclick = e =>{
      Login( inPW.value, 'Login')
    };
  }

  //From
  {
    form = document.createElement('form');
    form.method = 'POST';
    form.action = '';
    form.class = 'Login';
    form.append(inPW);
    form.append(sub);
  }

  //Error Wraper
  {
    errorWraper = document.createElement('div');
    errorWraper.className = 'errorWraper';
  }
  inputWraper.append(form);
  loginWraper.append(errorWraper);
}

function Login(password, operation) {
    fetch('php/LoginHandling.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      paswd: password,
      operation: operation
    })
  }).then(response=>response.text())
    .then(data=>{
      if (data == 'true') {
        window.location.replace('index.php')
      }else if (data =='false') {
        var errorWraper = document.querySelector('.errorWraper');
          errorWraper.innerHTML = '';
          errorWraper.append('Passwort falsch');
        }
    console.log(data);
  })
}
