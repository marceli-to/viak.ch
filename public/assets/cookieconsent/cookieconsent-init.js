import "/assets/cookieconsent/cookieconsent.umd.js";

/**
 * Enable suggestions
 * @type {import('../../types')}
 */
CookieConsent.run({
    
  cookie: {
    name: 'viak_cookie_consent',
  },
  
  guiOptions: {
    consentModal: {
      layout: "bar inline",
      position: "bottom center",
      equalWeightButtons: false,
      flipButtons: true
    },
    preferencesModal: {
      layout: "box",
      position: "right",
      equalWeightButtons: false,
      flipButtons: false
    }
  },

  onFirstConsent: () => {
  },

  onConsent: () => {
  },

  onChange: () => {
  },
  
  categories: {
    necessary: {
      readOnly: true,
      enabled: true
    },
    analytics: {
      autoClear: {
        cookies: [
          {
            name: /^(_ga|_gid)/
          }
        ]
      }
    },
    functionality: {},
  },

  language: {
    default: "de",
    autoDetect: "browser",
    translations: {
      de: {
        consentModal: {
          title: 'Verwendung von Cookies',
        
          description: 'Unsere Website verwendet Tracking-Cookies, um zu verstehen, wie Sie mit ihr interagieren. Das Tracking wird nur aktiviert, wenn Sie ausdrücklich zustimmen.',
          acceptAllBtn: 'Akzeptieren',
          acceptNecessaryBtn: 'Ablehnen',
          footer: `
            <a href="/media/downloads/Visualisierungs-Akademie_Datenschutzerklaerung_Feb23.pdf" target="_blank">Datenschutzerklärung</a>
          `
        },
        preferencesModal: {
        title: 'Cookie Einstellungen',
        acceptAllBtn: 'Alle akzeptieren',
        acceptNecessaryBtn: 'Alle ablehnen',
        savePreferencesBtn: 'Einstellungen speichern',
        closeIconLabel: 'Schliessen',
        sections: [
        {
            title: 'Verwendung von Cookies',
            description: 'Wir verwenden Cookies, um die grundlegenden Funktionen der Website sicherzustellen und Ihr Online-Erlebnis zu verbessern. Sie können für jede Kategorie wählen, ob Sie sich jederzeit an- oder abmelden möchten. Weitere Einzelheiten zu Cookies und anderen sensiblen Daten finden Sie in der vollständigen <a href="#" class="cc__link">Datenschutzerklärung</a>.'
        }, {
            title: 'Notwendige Cookies',
            description: 'Cookies sind unverzichtbar, damit unsere Webseite einwandfrei funktioniert. Sie ermöglichen grundlegende Funktionen wie Seitennavigation und Zugriff auf sichere Bereiche der Webseite. Diese Cookies sammeln keine Informationen über Sie, die für Marketingzwecke verwendet werden könnten oder merken, wo Sie im Internet gewesen sind. Ohne diese Cookies kann unsere Webseite nicht effizient funktionieren. Ihre Zustimmung zu diesen Cookies ist nicht erforderlich, da sie essentiell für die Bereitstellung der von Ihnen angeforderten Dienste sind.',
            linkedCategory: 'necessary'
        }, {
            title: 'Performance und Analyse Cookies',
            description: 'Performance- und Analyise-Cookies helfen uns, die Nutzung unserer Website zu verstehen und zu messen. Sie sammeln Informationen darüber, wie Besucher unsere Seite nutzen, welche Seiten am häufigsten besucht werden oder ob sie Fehlermeldungen von Webseiten erhalten. Diese Cookies sammeln keine Informationen, die einen Besucher direkt identifizieren. Alle Informationen, die durch diese Cookies gesammelt werden, sind aggregiert und daher anonym. Sie werden nur verwendet, um die Funktionsweise unserer Website zu verbessern. Durch die Zustimmung zu diesen Cookies tragen Sie zu einer optimierten Nutzungserfahrung bei.',
            linkedCategory: 'analytics'
        }, {
            title: 'Weitere Informationen',
            description: 'Für Fragen zu unserer Cookie-Richtlinie und Ihren Wahlmöglichkeiten stehen wir Ihnen gerne zur Verfügung. <a class="cc__link" href="https://www.chamgroup.ch/kontakt">Kontakt</a>.',
        }
        ]
      }
      },
    }
  }
});