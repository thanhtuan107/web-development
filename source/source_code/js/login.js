const login_sec = document.querySelector('.login-section')
const login_link = document.querySelector('.login-link')
const register_link = document.querySelector('.register-link')
register_link.addEventListener('click',()=>{
    login_sec.classList.add('active')
})
login_link.addEventListener('click',()=>{
    login_sec.classList.remove('active')
})

let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}