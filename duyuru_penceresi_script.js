window.onload = function () {
  const announcement = document.getElementById("announcement");
  
  announcement.classList.remove("hidden");
  
  // 5 saniye sonra duyuruyu kaldır
  setTimeout(() => {
    announcement.classList.add("hidden");
  }, 5000);
};
