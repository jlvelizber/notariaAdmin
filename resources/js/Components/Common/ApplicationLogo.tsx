import ImgLogo from '@asset/logo.png';
import { HtmlHTMLAttributes } from 'react';

export const ApplicationLogo = (props: HtmlHTMLAttributes<HTMLImageElement>) => {
    return (
        <img {...props} src={ImgLogo}/>
    );
};
