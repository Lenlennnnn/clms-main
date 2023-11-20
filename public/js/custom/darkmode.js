// let darkMode = localStorage.getItem('darkMode');
const darkModeToggle = document.querySelector('#darkModeToggle')

const enableDarkMode = () => {
    document.body.classList.add('darkmode');

    localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
    document.body.classList.remove('darkmode');

    localStorage.setItem('darkMode', 'disabled');
}

if(darkMode === "enabled"){
    darkModeToggle.checked = true;
    enableDarkMode();
}else{
    darkModeToggle.checked = false;
}

darkModeToggle.addEventListener('click', () => {
    let darkMode = localStorage.getItem('darkMode');
    if(darkMode !== 'enabled'){
        enableDarkMode();
    
    }else{
        disableDarkMode();
    }
})