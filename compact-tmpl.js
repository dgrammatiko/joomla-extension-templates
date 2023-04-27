import fs, { existsSync } from 'node:fs';
import { sep } from 'node:path';
import dirTree from 'directory-tree';

const folder = 'src';
const folderMedia = 'media_source';
const data = {};
const addContent = (item) => item.type === 'file' ? fs.readFileSync(item.path, {encoding: 'utf8'}) : '';
const fixPath = (item, php, ext) => php ? item.path : item.path
      .replace(`components${sep}`, '')
      .replace(`libraries${sep}`, '')
      .replace(`modules${sep}`, '')
      .replace(`plugins${sep}`, '');

function recurs(item, php, ext) {
  item.children.forEach((child) => {
    if (child.children) {
      recurs(child, php, ext);
      child.path = fixPath(child, php, ext);
      child.name = undefined;
    } else {
      child.contents = addContent(child, php, ext);
      child.path = fixPath(child, php, ext);
      child.name = undefined;
    }
  });
}

fs.readdirSync(folder).forEach((dir) => {
  const tree = dirTree(`${folder}/${dir}`, {attributes:['type']});

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

  if (!existsSync(`${folderMedia}/${dir}`)) return;
  const treeMedia = dirTree(`${folderMedia}/${dir}`, {attributes:['type']});

  treeMedia.children.forEach((child) => {
    if (child.children) {
      recurs(child, false, dir);
      child.path = fixPath(child, false, dir);
    } else {
      child.contents = addContent(child, false, dir)
      child.path = fixPath(child, false, dir);
    }
  });

  data[dir] = { php: tree.children, media: treeMedia.children };
});

if (!fs.existsSync('dist')) {
  fs.mkdirSync('dist');
}
fs.writeFileSync('dist/templates.js', `const template = ${JSON.stringify(data, null, 2)};\nexport {template};\n`, { encoding: 'utf-8' });

