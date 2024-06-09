import fs from 'node:fs';

const base = 'www';
const defaults = {};
const searchables = ["components", "libraries", "modules", "plugins", "templates"];

function getDirs(dir) {
  return fs.readdirSync(dir, { withFileTypes: true })
   .filter((dirent) => dirent.isDirectory())
   .map((dirent) => dirent.name);
}

for (const type of searchables) {
  switch (type) {
    case 'components': {
      const siteComps = getDirs(`${base}/${type}`).map((comp) => comp.replace('com_', ''));
      const adminComps = getDirs(`${base}/administrator/${type}`).map((comp) => comp.replace('com_', ''));
      defaults[type] = [];
      defaults[type].push(...siteComps,...adminComps);
      break;
    }
    case'modules': {
      const siteMods = getDirs(`${base}/${type}`).map((comp) => comp.replace('mod_', ''));
      const adminMods = getDirs(`${base}/administrator/${type}`).map((comp) => comp.replace('mod_', ''));
      defaults[type] = { administrator: adminMods, site: siteMods };
      break;
    }
    case 'templates': {
      const siteTmpls = getDirs(`${base}/${type}`);
      const adminTmpls = getDirs(`${base}/administrator/${type}`);
      defaults[type] = { administrator: adminTmpls, site: siteTmpls };
      break;
    }
    case 'libraries':{
      const libs = getDirs(`${base}/${type}`);
      defaults[type] = libs;
      break;
    }
    case 'plugins': {
      const plgTypes = getDirs(`${base}/${type}`);
      defaults[type] = {};
      for (const plgType of plgTypes) {
        defaults[type][plgType] = defaults[type][plgType] ? defaults[type][plgType] : [];
        for (const directory of fs.readdirSync(`${base}/plugins/${plgType}`)) {
          if (fs.statSync(`${base}/plugins/${plgType}/${directory}`).isDirectory()) {
            defaults[type][plgType].push(directory.replace(/^plg_/, ""));
          }
        }
      }
      break;
    }
  }
}

fs.writeFileSync('defaults.json', JSON.stringify(defaults, null, 2));
// console.dir(defaults);
