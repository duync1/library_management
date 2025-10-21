import $ from "jquery";

// Gắn jQuery lên global
window.$ = window.jQuery = $;

// Dùng import async để đảm bảo jQuery sẵn sàng trước khi load plugin
(async () => {
  await import("./plugin/jquery-scrollbar/jquery.scrollbar.min.js");
  await import("./core/popper.min.js");
  await import("./core/bootstrap.min.js");
  await import("./core/kaiadmin.min.js");
  await import("./plugin/jquery.sparkline/jquery.sparkline.min.js");

  // Sau khi các script đã load
  console.log("✅ All KaiAdmin scripts loaded successfully");
})();

// WebFont
import "./plugin/webfont/webfont.min.js";
WebFont.load({
  google: { families: ["Public Sans:300,400,500,600,700"] },
  custom: {
    families: [
      "Font Awesome 5 Solid",
      "Font Awesome 5 Regular",
      "Font Awesome 5 Brands",
      "simple-line-icons",
    ],
    urls: ["/resources/css/fonts.min.css"],
  },
  active: () => (sessionStorage.fonts = true),
});
