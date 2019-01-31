onload = e =>{
  var body = document.querySelector('body');
  var loginWraper = document.createElement('div');
  loginWraper.className='loginWraper';
  var notification =  document.createElement('h1');
  notification.innerText = 'You are not logged in';
  loginWraper.append(notification);

  var login = document.createElement('button');
  login.innerText = 'Login';
  login.onclick = e=>{
    MakeLogin();
  }

  loginWraper.append(login);
  body.append(loginWraper);
}

function MakeLogin() {
  var body = document.querySelector('body');
  var loginWraper = document.querySelector('.loginWraper');
  var form, inPW, sub, errorWraper;

  //Password Input
  {
    inPW = document.createElement('input');
    inPW.type='password';
    inPW.placeholder = 'Password';
    inPW.id = 'Password';
  }

  //Submit Button
  {
    sub = document.createElement('button');
    sub.type='button';
    sub.innerText = 'Login';
    sub.onclick = e =>{
      Login(inPW.value, 'Login')
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
  loginWraper.append(form);
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
          errorWraper.append('Not right pw');
        }
    console.log(data);
  })
}
