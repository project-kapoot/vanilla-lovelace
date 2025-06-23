window.addEventListener("DOMContentLoaded", () => {
    const rank = 4;
    const messageEl = document.querySelector(".motivation-message");

    let message = "";

    if (rank === 1) {
        message = "Incroyable ! Tu es premier 🥇";
    } else if (rank <= 3) {
        message = "Bien joué ! Tu es dans le top 3 🔥";
    } else if (rank <= 5) {
        message = "Ne lâche rien, tu peux remonter 💪";
    } else {
        message = "Garde le cap, tout est encore possible 👊";
    }

    messageEl.textContent = message;
});
