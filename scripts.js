const themes = [
    {
        background: "#1A1A2E",
        color: "#FFFFFF",
        primaryColor: "#0F3460"
    },
    {
        background: "#461220",
        color: "#FFFFFF",
        primaryColor: "#E94560"
    },
    {
        background: "#192A51",
        color: "#FFFFFF",
        primaryColor: "#967AA1"
    },
    {
        background: "#F7B267",
        color: "#000000",
        primaryColor: "#F4845F"
    },
    {
        background: "#F25F5C",
        color: "#000000",
        primaryColor: "#642B36"
    },
    {
        background: "#231F20",
        color: "#FFF",
        primaryColor: "#BB4430"
    }
];

const setTheme = (theme) => {
    const root = document.querySelector(":root");
    root.style.setProperty("--background", theme.background);
    root.style.setProperty("--color", theme.color);
    root.style.setProperty("--primary-color", theme.primaryColor);
    root.style.setProperty("--glass-color", theme.glassColor);
};

const displayThemeButtons = () => {
    const btnContainer = document.querySelector(".theme-btn-container");
    themes.forEach((theme) => {
        const div = document.createElement("div");
        div.className = "theme-btn";
        div.style.cssText = `background: ${theme.background}; width: 25px; height: 25px`;
        btnContainer.appendChild(div);
        div.addEventListener("click", () => setTheme(theme));
    });
};

displayThemeButtons();

document.addEventListener('DOMContentLoaded', function() {
    fetch('fetch_syntheses.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('syntheses-table-body');
            data.forEach(synthese => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${synthese.id}</td>
                    <td>${synthese.title}</td>
                    <td>${synthese.description}</td>
                    <td>${synthese.created_at}</td>
                    <td><a href="${synthese.file_path}" target="_blank">Voir le PDF</a></td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching syntheses:', error));
});