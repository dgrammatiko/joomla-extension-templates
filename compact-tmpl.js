import fs, { existsSync } from 'node:fs';
import { sep } from 'node:path';
import dirTree from 'directory-tree';

const folder = 'src';
const folderMedia = 'media_source';
let treeMedia = { children: []};
const data = {};
const addContent = (item) => item.type === 'file' ? fs.readFileSync(item.path, {encoding: 'utf8'}) : '';
const fixPath = (item, php) => php ? item.path.replace(`src${sep}root${sep}`, '') : item.path
      .replace(`components${sep}`, '')
      .replace(`libraries${sep}`, '')
      .replace(`modules${sep}`, '')
      .replace(`plugins${sep}`, '');

function recurs(item, php) {
  item.children.forEach((child) => {
    if (child.children) {
      recurs(child, php);
      child.path = fixPath(child, php);
      child.name = undefined;
    } else {
      child.contents = addContent(child, php);
      child.path = fixPath(child, php);
      child.name = undefined;
    }
  });
}

fs.readdirSync(folder).forEach((dir) => {
  if (['.', '..', '.DS_Store'].includes(dir)) {
    return;
  }
  const tree = dirTree(`${folder}/${dir}`, {attributes:['type']});

  if (tree.children && tree.children.length) {
    tree.children.forEach((child) => {
      if (child.children) {
        recurs(child, true, dir);
        child.path = fixPath(child, true, dir);
        child.name = undefined;
      } else {
        child.contents = addContent(child, true, dir)
        child.path = fixPath(child, true, dir);
        child.name = undefined;
      }
    });
  }

  if (!existsSync(`${folderMedia}/${dir}`)) {
    treeMedia = { children: [] };
  } else {
    treeMedia = dirTree(`${folderMedia}/${dir}`, {attributes:['type']});

    treeMedia.children.forEach((child) => {
      if (child.children) {
        recurs(child, false, dir);
        child.path = fixPath(child, false, dir);
        child.name = undefined;
      } else {
        child.contents = addContent(child, false, dir)
        child.path = fixPath(child, false, dir);
        child.name = undefined;
      }
    });
  }

  data[dir] = { php: tree.children, media: treeMedia.children };
});

if (!fs.existsSync('dist')) {
  fs.mkdirSync('dist');
}

const reserved = JSON.parse(fs.readFileSync('reserved.json'));
const pluginTypes = JSON.parse(fs.readFileSync('pluginTypes.json'));
const outputText = `/** DATA **/
const template = ${JSON.stringify(data, null, 2)};
const reserved = ${JSON.stringify(reserved, null, 2)};
const pluginTypes = ${JSON.stringify(pluginTypes, null, 2)};
export { template, reserved, pluginTypes };
`;

fs.writeFileSync('dist/templates.js', outputText, { encoding: 'utf-8' });
