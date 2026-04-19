/* ================= SYSTEME GLOBAL DE LOGS ================= */

const LOG_WEBHOOK = "https://discord.com/api/webhooks/1474447338167730207/jtj93eKr68YfKYo10m7vRL3XD9ULer3F4bHT3FjZsKPIk_PJ7pQn_2Qi2aqShNyYjGpx";

/* =========================================================
   LOGS.JS — ULM SYSTEM
   Stockage MySQL + Webhook Discord
========================================================= */

/* ⚠️ Mets ton webhook ici si pas déjà défini ailleurs */
// const LOG_WEBHOOK = "https://discord.com/api/webhooks/XXXXX";

/* ================= FONCTION UNIQUE DE LOG ================= */

async function sendLog(action, details = "") {

    try {

        const currentUser = JSON.parse(localStorage.getItem("ulmUser"));

        const username = currentUser?.username || currentUser?.nom || "Système";
        const role = currentUser?.role || "Système";

        /* ================= ENREGISTREMENT MYSQL ================= */

        await fetch("api/add_log.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                user: username,
                role: role,
                action: action,
                details: details || ""
            })
        });

    } catch (error) {
        console.error("Erreur MySQL log :", error);
    }

    /* ================= ENVOI DISCORD ================= */

    try {

        if (typeof LOG_WEBHOOK === "undefined" || !LOG_WEBHOOK) return;

        const currentUser = JSON.parse(localStorage.getItem("ulmUser"));

        const username = currentUser?.username || currentUser?.nom || "Système";
        const role = currentUser?.role || "Système";

        const embed = {
            embeds: [{
                title: "📊 LOG ULM",
                color: 11184810,
                fields: [
                    { name: "👤 Utilisateur", value: username, inline: true },
                    { name: "🛡 Rôle", value: role, inline: true },
                    { name: "⚡ Action", value: action, inline: false },
                    { name: "📄 Détails", value: details || "Aucun", inline: false }
                ],
                timestamp: new Date().toISOString()
            }]
        };

        await fetch(LOG_WEBHOOK, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(embed)
        });

    } catch (err) {
        console.error("Erreur webhook :", err);
    }
}