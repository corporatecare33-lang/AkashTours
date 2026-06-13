import { cpSync, existsSync, mkdirSync, rmSync } from 'node:fs';
import { join } from 'node:path';

const publicDir = join(process.cwd(), 'public');
const distDir = join(process.cwd(), 'dist');

rmSync(distDir, { force: true, recursive: true });
mkdirSync(distDir, { recursive: true });

if (existsSync(publicDir)) {
    cpSync(publicDir, distDir, { recursive: true });
}
