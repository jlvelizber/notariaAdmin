import ImgLogo from '@asset/logo.png'

export default function ApplicationLogo(props: any) {
    return (
        <img {...props} src={ImgLogo}/>
    );
}
